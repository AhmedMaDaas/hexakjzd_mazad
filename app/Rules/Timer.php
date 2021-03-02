<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Timer implements Rule
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
        $string = preg_replace("/(([0-9]+):([0-5][0-9]):([0-5][0-9])|\s+)/", '', $value);
        $match = preg_match("/([0-9]+):([0-5][0-9]):([0-5][0-9])/", $value) === 1;
        return empty($string) && $string !== '0' && $match;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
