<?php

namespace App\Http\Requests;

use App\Contract;
use Illuminate\Validation\Rule;

class ContractRequestPost extends BaseRequest
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
            'number' => 'required|string',
            'type' => [
                Rule::in(Contract::TYPES),
                'string'
            ],
            'start_date' => 'required|date_format:"Y-m-d"|before:end_date',
            'end_date' => 'required|date_format:"Y-m-d"|after:start_date',
            'rent_per_acre' => 'required_if:type,' . Contract::TYPE_RENT . '|numeric|nullable',
            'price' => 'required_if:type,' . Contract::TYPE_OWNERSHIP . '|numeric|nullable'
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
            'number.required' => __('number is required'),
            'number.string' => __('number must be string'),
            'type.required' => __('number is required'),
            'type.string' => __('number must be string.'),
            'type.in' => __('Excepted values: ' . implode(', ', Contract::TYPES)),
            'start_date.required' => __('start_date is required'),
            'start_date.date' => __('start_date must be a valid Date.'),
            'end_date.required' => __('end_date is required'),
            'end_date.date' => __('end_date must be a valid Date.'),
            'rent_per_acre.numeric' => __('rent_per_acre must be numeric.'),
            'rent_per_acre.required_if' => __('The rent_per_acre field is required when type is ' . Contract::TYPE_RENT . '.'),
            'price.numeric' => __('rent_per_acre must be numeric.'),
            'price.required_if' => __('The price field is required when type is ' . Contract::TYPE_OWNERSHIP . '.')
        ];
    }

}
