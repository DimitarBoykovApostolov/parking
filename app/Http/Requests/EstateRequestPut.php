<?php

namespace App\Http\Requests;

class EstateRequestPut extends BaseRequest
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
            'unique_number' => 'unique:estates',
            'area_in_acres' => 'numeric'
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
            'unique_number.unique' => __('unique_number must be unique'),
            'area_in_acres.numeric' => __('area_in_acres must be numeric'),
        ];
    }
}
