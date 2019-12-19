<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

abstract class BaseModel extends Model
{
    use SoftDeletes;

    const ITEMS_PER_PAGE = 25;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = '_id';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
