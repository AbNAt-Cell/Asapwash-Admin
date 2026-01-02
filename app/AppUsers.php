<?php

namespace App;

use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUsers extends Authenticatable
{
    //
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'phone_no',
        'otp',
        'address',
        'status',
        'image',
        'password',
        'device_token',
        'liked_salon',
        'noti',
        'verified'
    ];
    protected $table = 'app_users';
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];
    protected $appends = ['imageUri'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['image'])) {

            return url('public/upload/') . '/' . $this->attributes['image'];
        }
    }
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

}
