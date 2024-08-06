<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\brandsModel;
use App\Models\generationsModel;
use App\Models\carsModel;

class modelsModel extends Model
{
    use HasFactory;

    protected $table = 'models';

    protected $fillable = [
        'brand_id',
        'model',
        'description',
        'feature',
        'evtype',
        'meta_keyword',
        'meta_title',
        'meta_description',
    ];

    public function brand()
    {
        return $this->belongsTo(brandsModel::class, 'brand_id');
    }

    public function generations()
    {
        return $this->hasMany(generationsModel::class, 'models_id');
    }

    public function cars()
    {
        return $this->hasMany(carsModel::class, 'model_id');
    }
}
