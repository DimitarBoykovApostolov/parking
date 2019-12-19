<?php

namespace App\Http\Requests;

class UserRegistration extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'license_plate' => 'string|required|unique:user',
            'discount_card' => 'string|required|exists:discount_card,name',
            'parking_id' => 'string|required|exists:parking,_id',
            'setting_id' => 'string|required|exists:setting,_id',
        ];
    }
}
