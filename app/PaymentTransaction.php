<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    //
    public $table = 'payment_transaction';

    protected $fillable = [
        'owner_id', 'booking_id', 'admin_share', 'owner_share', 'payment', 'shattle', 'shattle_at'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'shattle_at',

    ];
    protected $appends = ['currency'];
    public function getCurrencyAttribute()
    {
        return    AdminSetting::first()->currency_symbol;
    }
    public function Owner()
    {
        return $this->belongsTo('App\ShopOwner', 'owner_id', 'id');
    }
    public function Booking()
    {
        return $this->belongsTo('App\Booking', 'booking_id', 'id');
    }
}
