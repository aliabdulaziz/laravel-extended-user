<?php

namespace Aliabdulaziz\LaravelExtendedUser\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Aliabdulaziz\LaravelExtendedUser\Requests\UpdateUserProfile;


class ProfileController extends Controller
{

    /**
     * Construct the user object.
     *
     * @return \App\User
     */
    public function user()
    {
        $user  = auth()->user();
        $user->profile = unserialize($user->profile);
        $user->image = (
            isset($user->profile['image'])
        ) ? $user->profile['image'] : 'images/user-icon.svg';
        return $user;
    }


    /**
     * Show user own profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('laravelextendeduser::pages.user.profile.show', [
            'user' => $this->user()
        ]);
    }

    /**
     * Show edit user own profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('laravelextendeduser::pages.user.profile.edit', [
            'user' => $this->user()
        ]);
    }

    /**
     * Update user own profile.
     *
     * @param  \Aliabdulaziz\LaravelExtendedUser\Requests\UpdateUserProfile  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfile $request)
    {
        request()->flash();

        // Get the user
        $user = $this->user();
        unset($user->image);

        // Add the data to the profile
        $path = $user->profile['image'];

        if ($request->image) {
            $path = $this->image($request->image);
        }

        $data = $request->except(['_token', '_method', 'name', 'image']);
        $data['image'] = $path;
        $user->profile = serialize($data);

        // save the changes
        $user->save();

        return redirect('profile')->with('status', 'Profile updated successfully!');
    }

    /**
     * Save the profile image and return the path.
     *
     * @param  $image
     * @return string
     */
    public function image($image)
    {
        if (is_file($image)) {

            $user   = auth()->user();
            
            $file   = $image;
            $name   = str_random(10).'.'.$file->extension();
            $dir    = 'public/user/'.$user->id;

            // Delete old image if existing
            if (isset($user->profile)) {

                $profile = $user->profile;

                if (isset($profile['image'])) {

                    $oldImage = preg_replace(
                        '/^storage/ui', 'public', $profile['image']
                    );

                    Storage::delete($oldImage);

                    preg_match('/[a-z0-9\.]+$/ui', $oldImage, $matches);

                    $oldIcon = preg_replace(
                        '/[a-z0-9\.]+$/ui', 'sm-'.$matches[0], $oldImage
                    );

                    Storage::delete($oldIcon);
                }
            }

            // Resize and crop the new image
            $file = Image::make($file)->fit(128);

            // Create a directory for the image if not existing
            if (!file_exists(storage_path('app/'.$dir))) {        
                Storage::makeDirectory($dir);
            }

            // Store the new image in the storage
            $file->save(storage_path('app/'.$dir).'/'.$name);

            // Create image icon and store it with the image
            $icon = Image::make($file)->fit(32);
            $icon->save(storage_path('app/'.$dir).'/sm-'.$name);
            
            // return image public path
            return 'storage/user/'.$user->id.'/'.$name; 
        }

        return null;
    }

    /**
     * Remove user own profile image.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove()
    {
        // Get the user
        $user = $this->user();
        unset($user->image);

        // Delete old image if existing
        if (isset($user->profile)) {

            $profile = $user->profile;

            if (isset($profile['image'])) {

                $oldImage = preg_replace(
                    '/^storage/ui', 'public', $profile['image']
                );

                Storage::delete($oldImage);

                preg_match('/[a-z0-9\.]+$/ui', $oldImage, $matches);

                $oldIcon = preg_replace(
                    '/[a-z0-9\.]+$/ui', 'sm-'.$matches[0], $oldImage
                );

                Storage::delete($oldIcon);
            }

            $profile['image'] = null;

            $user->profile = serialize($profile);
        }

        $user->save();

        return redirect('profile')->with('status', 'Profile image removed successfully!');
    }
}
