<?php

namespace Aliabdulaziz\LaravelExtendedUser\Rules;

use Illuminate\Contracts\Validation\Rule;

use Illuminate\Support\Facades\Hash;

class MatchingUserPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $password = auth()->user()->password;

        return Hash::check($value, $password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute you entered is in-correct.';
    }
}
