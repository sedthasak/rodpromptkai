<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\generationsModel;
use App\Models\carsModel;

class sub_modelsModel extends Model
{
    use HasFactory;

    protected $table = 'sub_models';

    protected $fillable = [
        'generations_id',
        'sub_models',
        'description',
        'feature',
        'meta_keyword',
        'meta_title',
        'meta_description',
    ];

    public function generation()
    {
        return $this->belongsTo(generationsModel::class, 'generations_id');
    }

    public function cars()
    {
        return $this->hasMany(carsModel::class, 'sub_models_id');
    }
}
