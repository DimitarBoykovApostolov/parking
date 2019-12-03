<?php

namespace App\Rules;

use App\Contract;
use Illuminate\Contracts\Validation\Rule;

class LessorToEstate implements Rule
{

    public $id;

    /**
     * Create a new rule instance.
     *
     * LessorToEstate constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
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
        $contract = Contract::findOrFail($this->id);
        if($contract->type == Contract::TYPE_OWNERSHIP) {
            foreach ($value as $data) {
                if (count($data['lessors']) > 0) {
                    return false;
                }
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
        return 'Estates in contract of type "ownership" could not have lessors.';
    }
}
