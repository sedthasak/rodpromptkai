<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CouponModel;
use App\Models\OrderModel;

class CouponUse extends Model
{
    use HasFactory;

    protected $table = 'coupons_use';

    protected $fillable = [
        'coupons_id',
        'name',
        'code',
        'rate',
        'limit_rate',
        'orders_id',
        'total',
        'discount',
    ];

    /**
     * Get the coupon associated with this use.
     */
    public function coupon()
    {
        return $this->belongsTo(CouponModel::class, 'coupons_id');
    }

    /**
     * Get the order associated with this use.
     */
    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'orders_id');
    }
}
