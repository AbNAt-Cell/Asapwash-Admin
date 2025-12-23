<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticNoti extends Model
{
    //
    public $table = 'static_notification';

    protected $dates = [
        'created_at',
        'updated_at',

    ];

    protected $fillable = [
        'for_what', 'title', 'sub_title', 'status', 'for_who'
    ];
}
