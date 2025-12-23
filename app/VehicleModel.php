<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    //
    protected $guarded = [];
    protected $hidden = [
        'updated_at',
        'created_at',
     
    ];
    public $table = 'vehicle_model';
    public function Brand()
    {
        return $this->belongsTo('App\VehicleBrand', 'brand_id', 'id');
    }
}
