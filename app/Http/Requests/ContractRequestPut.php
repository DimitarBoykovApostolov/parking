<?php

namespace App\Http\Requests;

use App\Contract;
use Illuminate\Validation\Rule;

class ContractRequestPut extends BaseRequest
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
            'number' => 'string',
            'type' => [
                Rule::in(Contract::TYPES),
                'string'
            ],
            'start_date' => 'date_format:"Y-m-d"',
            'end_date' => 'date_format:"Y-m-d"',
            'rent_per_acre' => 'numeric',
            'price' => 'numeric'
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
            'number.string' => __('number must be string'),
            'type.string' => __('number must be string.'),
            'type.in' => __('Excepted values: ' . implode(', ', Contract::TYPES)),
            'start_date.date' => __('start_date must be a valid Date.'),
            'end_date.date' => __('end_date must be a valid Date.'),
            'rent_per_acre.numeric' => __('rent_per_acre must be numeric.'),
            'price.numeric' => __('rent_per_acre must be numeric.')
        ];
    }
}
