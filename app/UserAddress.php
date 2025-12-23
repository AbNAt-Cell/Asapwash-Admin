<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    //
    protected $guarded = [];
    public $table = 'user_address';
    protected $hidden = [
        'updated_at',
        'created_at',

    ];
}
