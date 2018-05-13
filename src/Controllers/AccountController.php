<?php

namespace Aliabdulaziz\LaravelExtendedUser\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Aliabdulaziz\LaravelExtendedUser\Rules\MatchingUserPassword;
use Aliabdulaziz\LaravelExtendedUser\Requests\ChangeUserPassword;

class AccountController extends Controller
{
    /**
     * Show user own account.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('laravelextendeduser::pages.user.account.show', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Update user own account.
     *
     * @param  \Aliabdulaziz\LaravelExtendedUser\Requests\ChangeUserPassword  $request
     * @return \Illuminate\Http\Response
     */
    public function update(ChangeUserPassword $request)
    {
        $user = auth()->user();

        $user->password = Hash::make($request->new_password);

        $user->save();

        return redirect('account')->with('status', 'Psssword changed successfully!');
    }

    /**
     * Show user own account deletion page.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        return view('laravelextendeduser::pages.user.account.delete', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Delete user own account.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:6', new MatchingUserPassword],
        ]);

        $user = auth()->user();

        // Delete user directory
        if (file_exists(storage_path('app/public/user'))) {
            Storage::deleteDirectory('public/user');
        }
        
        auth()->logout();

        $user->delete();

        return redirect('/')->with('status', 'Your account has been deleted successfully!');
    }
}
