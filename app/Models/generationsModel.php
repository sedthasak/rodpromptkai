<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\modelsModel;
use App\Models\sub_modelsModel;
use App\Models\carsModel;

class generationsModel extends Model
{
    use HasFactory;

    protected $table = 'generations';

    protected $fillable = [
        'models_id',
        'generations',
        'yearfirst',
        'yearlast',
        'description',
        'feature'
    ];

    public function model()
    {
        return $this->belongsTo(modelsModel::class, 'models_id');
    }

    public function subModels()
    {
        return $this->hasMany(sub_modelsModel::class, 'generations_id');
    }

    public function cars()
    {
        return $this->hasMany(carsModel::class, 'generations_id');
    }
}
