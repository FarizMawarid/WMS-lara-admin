<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'po',
        'kp',
        'season',
        'style',
        'destination'
    ];
}