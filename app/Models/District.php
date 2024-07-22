<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Province;
use App\Models\SubDistrict;

class District extends Model
{
    use HasFactory;

    protected $table = 'geo_districts';
    protected $fillable = ['code', 'name_th', 'name_en', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    public function subDistricts()
    {
        return $this->hasMany(SubDistrict::class, 'district_id');
    }
}
