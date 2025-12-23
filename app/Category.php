<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    use SoftDeletes;

    public $table = 'categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name', 'icon', 'is_trending', 'status'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $appends = ['imageUri'];
    public function getImageUriAttribute()
    {
        if (isset($this->attributes['icon'])) {

            return url('upload/') . '/' . $this->attributes['icon'];
        }
    }
    public function Service()
    {
        return $this->hasMany('App\SubCategory', 'cat_id', 'id')->where('status', 1);
    }
}
