<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerShop extends Model
{
    //

    protected $fillable = [
        'owner_id',
        'service_id',
        'employee_id',
        'name',
        'address',
        'image',
        'phone_no',
        'is_popular',
        'is_best',
        'status',
        'end_time',
        'start_time',
        'package_id',
        'service_type',
        'lat',
        'lng'
    ];
    protected $table = 'owner_shops';
    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $appends = ['imageUri', 'avg_rating'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['image'])) {

            return url('upload/') . '/' . $this->attributes['image'];
        }
    }
    public function getServiceIdAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }
    public function getEmployeeIdAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }
    public function getPackageIdAttribute($value)
    {
        return $value ? explode(',', $value) : [];
    }

    public function getAvgRatingAttribute()
    {

        $revData = Review::where('shop_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');
        if ($star > 1) {
            $t = $star / count($revData);
            return number_format($t, 1, '.', '');
        }
        return 0;
    }
    public function getServiceDataAttribute()
    {
        if (!isset($this->attributes['service_id']) || empty($this->attributes['service_id'])) {
            return [];
        }
        return SubCategories::whereIn('id', explode(',', $this->attributes['service_id']))->get(['name', 'id', 'description', 'duration', 'price']);
    }
    public function getEmployeeDataAttribute()
    {
        if (!isset($this->attributes['employee_id']) || empty($this->attributes['employee_id'])) {
            return [];
        }
        return ShopEmployee::whereIn('id', explode(',', $this->attributes['employee_id']))->get(['name', 'id', 'email', 'online', 'image']);
    }
    public function getPackageDataAttribute()
    {
        if (!isset($this->attributes['package_id']) || empty($this->attributes['package_id'])) {
            return [];
        }
        return Package::whereIn('id', explode(',', $this->attributes['package_id']))->get();
    }
    public function Reviews()
    {
        return $this->hasMany('App\Review', 'shop_id', 'id')->orderBy('created_at', 'desc');
    }
    public function Bookings()
    {
        return $this->hasMany('App\BookingMaster', 'shop_id', 'id')->orderBy('created_at', 'desc');
    }
}
