<?php

namespace App;

class Contract extends BaseModel
{
    const TYPE_RENT = 'rent';
    const TYPE_OWNERSHIP = 'ownership';
    const TYPES = [
        self::TYPE_RENT,
        self::TYPE_OWNERSHIP
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
        'type',
        'start_date',
        'end_date',
        'rent_per_acre',
        'price',
    ];
}
