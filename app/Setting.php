<?php

namespace App;

class Setting extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'setting';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parking_id',
        'category',
        'daily_from',
        'daily_to',
        'daily_rate',
        'nightly_from',
        'nightly_to',
        'nightly_rate',
        'take_up_places'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
