<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\carsModel;
use App\Models\modelsModel;

class brandsModel extends Model
{
    use HasFactory;

    protected $table = 'brands';

    protected $fillable = [
        'title',
        'feature',
        'excerpt',
        'content',
        'user_id',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'sort_no'
    ];

    public function cars()
    {
        return $this->hasMany(carsModel::class, 'brand_id');
    }

    public function models()
    {
        return $this->hasMany(modelsModel::class, 'brand_id');
    }
}
