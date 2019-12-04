<?php

namespace App\Http\Requests;

use App\Rules\PhoneNumber;

class LessorRequestPut extends BaseRequest
{
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
            'phone' => ['numeric', new PhoneNumber()],
            'pin' => 'numeric'
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
            'pin.numeric' => 'pin must be numeric',
        ];
    }
}
