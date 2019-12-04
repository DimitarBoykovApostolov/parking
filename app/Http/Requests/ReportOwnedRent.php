<?php

namespace App\Http\Requests;

class ReportOwnedRent extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contractNumber' => 'string',
            'estateNumber' => 'numeric',
            'lessorName' => 'string',
            'date' => 'date_format:"Y-m-d',
        ];
    }
}
