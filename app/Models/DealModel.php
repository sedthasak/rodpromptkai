<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DealModel extends Model
{
    use HasFactory;

    protected $table = 'deals';

    protected $fillable = [
        'name',
        'border',
        'background',
        'image_background',
        'font1',
        'font2',
        'font3',
        'topleft',
        'bottomright',
        'expire',
        'bigbrand',
    ];

    protected $casts = [
        'expire' => 'datetime',
        'bigbrand' => 'boolean',
    ];
}
