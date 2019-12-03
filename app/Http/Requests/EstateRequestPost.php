<?php

namespace App\Http\Requests;

class EstateRequestPost extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unique_number' => 'required|numeric|unique:estates',
            'area_in_acres' => 'required|numeric'
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
            'unique_number.required' => __('unique_number is required'),
            'unique_number.unique' => __('unique_number must be unique'),
            'area_in_acres.required' => __('area_in_acres is required'),
            'area_in_acres.numeric' => __('area_in_acres must be numeric'),
        ];
    }
}
