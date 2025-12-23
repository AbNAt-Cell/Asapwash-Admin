<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    //
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'question', 'answer'
    ];
    protected $table = 'faq';
}
