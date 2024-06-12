<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $fillable = [
        'name',
        'accumulate',
        'coupon',
        'color',
        'ref',
    ];
}
