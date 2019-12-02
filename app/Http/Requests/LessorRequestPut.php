<?php

namespace App\Http\Requests;

class LessorRequestPut extends BaseRequest
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
            'first_name' => 'string',
            'last_name' => 'string',
            'phone' => 'numeric|phone_number',
            'pin' => 'unique:lessors'
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
            'first_name.string' => 'first_name must be string',
            'last_name.string' => 'last_name must be string',
            'phone.numeric' => 'first_name must be numeric',
            'phone.phone_number' => 'phone must be valid phone number format',
            'pin.unique' => 'pin must be unique',
        ];
    }
}
