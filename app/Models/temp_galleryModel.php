<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class temp_galleryModel extends Model
{
    use HasFactory;

    protected $table = 'temp_gallery';

    protected $fillable = [
        'cars_id',
        'gallery',
        'type',
        'pre_id'
    ];

    public function car()
    {
        return $this->belongsTo(temp_carsModel::class, 'cars_id');
    }
}
