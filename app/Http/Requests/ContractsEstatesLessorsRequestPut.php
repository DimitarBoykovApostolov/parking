<?php

namespace App\Http\Requests;

use App\Rules\CheckLessorsPercentage;
use App\Rules\LessorToEstate;
use App\Rules\UniqueLessors;

class ContractsEstatesLessorsRequestPut extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'estates' => [ 'required', 'array', new UniqueLessors(), new CheckLessorsPercentage(), new LessorToEstate($this->route('id'))],
            'estates.*.estate_id' => 'distinct'
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
            'estates.required' => __('estates is required'),
            'estates.array' => __('estates must be array'),
            'estates.distinct' => __('estate_id must be distinct'),
        ];
    }
}
