<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CouponModel extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    protected $fillable = [
        'name',
        'code',
        'rate',
        'have_expire',
        'limit_rate',
        'expirecoupon',
        'description',
        'limit',
        'status',
        'level_member',
    ];

    protected $casts = [
        'expirecoupon' => 'datetime',
    ];

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_member');
    }
}
