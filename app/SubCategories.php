<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    //

    public $table = 'sub_categories';
    protected $fillable = [
        'owner_id', 'cat_id', 'name', 'status', 'price', 'duration', 'description'
    ];
    protected $hidden = [
        'updated_at',
        'created_at',

    ];
    protected $appends = ['currency'];
    public function getCurrencyAttribute()
    {
        return    AdminSetting::first()->currency_symbol;
    }
}
