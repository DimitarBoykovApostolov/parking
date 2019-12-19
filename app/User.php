<?php

namespace App;


class User extends BaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'license_plate',
        'parking_id',
        'card_id',
        'setting_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function settings(){
        return $this->hasOne(Setting::class, '_id', 'setting_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function discount_card(){
        return $this->hasOne(DiscountCard::class, '_id', 'card_id');
    }

}
