<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\District;

class Province extends Model
{
    use HasFactory;

    protected $table = 'geo_provinces';
    protected $fillable = ['code', 'name_th', 'name_en', 'geography_id'];

    public function districts()
    {
        return $this->hasMany(District::class, 'province_id');
    }
}
