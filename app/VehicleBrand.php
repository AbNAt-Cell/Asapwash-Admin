<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleBrand extends Model
{
    //
    protected $guarded = [];
    public $table = 'vehicle_brand';
    protected $hidden = [
        'updated_at',
        'created_at',

    ];
    protected $appends = ['imageUri'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }
}
