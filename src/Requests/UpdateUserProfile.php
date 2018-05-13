<?php

namespace Aliabdulaziz\LaravelExtendedUser\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => 'image|max:1000|mimes:jpeg,jpg,png,gif',
            'name' => 'required|string|max:25',
            'job' => 'string|nullable|max:50',
            'company' => 'string|nullable|max:100',
            'phones.*.0' => 'nullable|digits_between:1,6',
            'phones.*.1' => 'nullable|digits_between:1,24',
            'mobiles.*.0' => 'nullable|digits_between:1,6',
            'mobiles.*.1' => 'nullable|digits_between:8,24',
            'emails.*' => 'nullable|email|max:64',
            'country' => 'string|nullable|max:32',
            'city' => 'string|nullable|max:32',
            'road' => 'string|nullable|max:32',
            'building' => 'string|nullable|max:32',
            'office' => 'string|nullable|max:32',
            'extra_details' => 'string|nullable|max:64',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'image.mimes' => 'The image type is invalid. Valid types are: JPG, JPEG, PNG, and GIF.',
            'phones.*.0.digits_between' => 'The phone number prefix must be between 1 and 6 digits.',
            'phones.*.1.digits_between' => 'The phone number must be between 1 and 24 digits.',
            'mobiles.*.0.digits_between' => 'The mobile number prefix must be between 1 and 6 digits.',
            'mobiles.*.1.digits_between' => 'The mobile number must be between 8 and 24 digits.',
            'emails.*.email' => 'The email must be a valid email address.',
            'emails.*.max' => 'The email must not be larger than 64 characters.'
        ];
    }
}
