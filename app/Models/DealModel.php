<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\MyDeal;

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
        'font4',
        'topleft',
        'topleft_position',
        'bottomright',
        'expire',
        'bigbrand',
        'text1',
        'text2',
        'text3',
        'text4',
        'text5',
        'text6',
    ];

    protected $casts = [
        'expire' => 'datetime',
        'bigbrand' => 'boolean',
    ];

    // Define the hasMany relationship
    public function myDeals()
    {
        return $this->hasMany(MyDeal::class, 'deals_id');
    }
}
