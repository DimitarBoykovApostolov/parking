<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckLessorsPercentage implements Rule
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
        foreach ($value as $data) {
            if (array_sum(array_values($data['lessors'])) > 100) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The sum of percentages of oll lessors must be equal or below 100%';
    }
}
