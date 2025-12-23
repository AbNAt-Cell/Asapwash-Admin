<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    //
    protected $guarded = [];
    public $table = 'user_vehicle';
    protected $hidden = [
        'updated_at',
        'created_at',

    ];
    public function Model()
    {
        return $this->belongsTo('App\VehicleModel', 'model_id', 'id');
    }
}
