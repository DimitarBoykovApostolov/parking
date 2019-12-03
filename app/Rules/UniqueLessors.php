<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueLessors implements Rule
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
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $data) {
            if (count($data['lessors']) !== count(array_unique(array_keys($data['lessors'])))) {
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
        return 'Lessors must be unique for given estate.';
    }
}
