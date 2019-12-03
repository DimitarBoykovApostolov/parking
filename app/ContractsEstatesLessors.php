<?php

namespace App;

class ContractsEstatesLessors extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts_estates_lessors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contract_id',
        'estate_id',
        'lessor_id',
        'ownership'
    ];
}
