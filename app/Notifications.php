<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    //
    public $table = 'notification_tbl';
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'booking_id', 'user_id', 'owner_id', 'title', 'sub_title', 'emp_id'
    ];
   
}
