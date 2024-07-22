<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\District;

class SubDistrict extends Model
{
    use HasFactory;

    protected $table = 'geo_subdistricts';
    protected $fillable = ['zip_code', 'name_th', 'name_en', 'district_id'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
