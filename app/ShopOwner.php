<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
class ShopOwner extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'name', 'email', 'phone_no', 'otp', 'status', 'image', 'password', 'device_token', 'noti', 'verified', 'auto_assign', 'emp_decline_req'
    ];
    protected $table = 'shop_owner';
    protected $hidden = [
        'password', 'created_at', 'updated_at','otp'
    ];
    protected $appends = ['imageUri'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['image'])) {

            return url('upload/') . '/' . $this->attributes['image'];
        }
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
    public function Shop()
    {
        return $this->hasMany('App\OwnerShop', 'owner_id', 'id');
    }

}
