<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BookingMaster extends Model
{
    //
    protected $guarded = [];
    public $table = 'booking_master';
    protected $appends = ['currency'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderStatus', function (Builder $builder) {
            $builder->orderby('start_time', 'desc');
        });
    }
    public function getCurrencyAttribute()
    {
        return    AdminSetting::first()->currency_symbol;
    }
    public function Model()
    {
        return $this->belongsTo('App\UserVehicle', 'vehicle_id', 'id');
    }
    public function Shop()
    {
        return $this->belongsTo('App\OwnerShop', 'shop_id', 'id');
    }
    public function Owner()
    {
        return $this->belongsTo('App\ShopOwner', 'owner_id', 'id');
    }
    public function User()
    {
        return  $this->belongsTo('App\AppUsers', 'user_id', 'id');
    }
    public function Employee()
    {

        return  $this->belongsTo('App\ShopEmployee', 'employee_id', 'id');
    }
    public function getServiceAttribute($value)
    {
        return explode(',', $value);
    }
    public function getServiceDataAttribute()
    {
        return  SubCategories::whereIn('id', explode(',', $this->attributes['service']))->get(['name', 'id','price']);
    }
    public function Review()
    {
        return $this->hasOne('App\Review', 'booking_id', 'id');
    }

}
