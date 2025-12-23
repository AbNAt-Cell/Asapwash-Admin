<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
class ShopEmployee extends Authenticatable
{
    //
    use HasApiTokens, Notifiable;
    protected $fillable = [
        'owner_id', 'email', 'phone_no', 'name', 'status', 'image', 'password', 'device_token', 'noti', 'start_time', 'end_time', 'experience', 'id_no', 'online','otp'
    ];
    protected $table = 'shop_employee';
    protected $hidden = [
        'password', 'created_at', 'updated_at'
    ];
    protected $appends = ['imageUri'];

    public function getAvgRatingAttribute()
    {

        $revData = Review::where('employee_id', $this->attributes['id'])->get();
        $star = $revData->sum('star');
        if ($star > 1) {
            $t = $star / count($revData);
            return number_format($t, 1, '.', '');
        }
        return 0;
    }
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
    public function Reviews()
    {
        return $this->hasMany('App\Review', 'employee_id', 'id')->orderBy('created_at', 'desc');
    }
    public function Booking()
    {
        return $this->hasMany('App\BookingMaster', 'employee_id', 'id')->orderBy('created_at', 'desc');
    }
}
