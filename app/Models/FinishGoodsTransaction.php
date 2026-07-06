<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinishGoodsTransaction extends Model
{
    protected $fillable = [
        'po',
        'style',
        'destination',
        'qty_carton',
        'qty_garment',
        'rack_code',
        'action_type',
    ];
}
