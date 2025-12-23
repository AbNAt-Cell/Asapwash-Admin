<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $table = 'package';
    protected $fillable = [
        'owner_id', 'service', 'name', 'status', 'price', 'duration', 'description'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',   
    ];
    protected $appends = ['currency', 'serviceData'];
    public function getCurrencyAttribute()
    {
        return    AdminSetting::first()->currency_symbol;
    }
    public function getServiceAttribute($value)
    {
        return explode(',', $value);
    }
    public function getServiceDataAttribute()
    {
        return  SubCategories::whereIn('id', explode(',', $this->attributes['service']))->get(['name', 'id']);
    }
    //
}
