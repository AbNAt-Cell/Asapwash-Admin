<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    //
    protected $fillable = [
        'pp', 'notification', 'currency_symbol', 'currency', 'verification', 'country_code', 'paypal_status', 'razor_status', 'phone_no', 'email', 'address', 'ios_version', 'android_version', 'offline_payment', 'time_slot_length','admin_per'
    ];
    protected $table = 'admin_setting';
}
