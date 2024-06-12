<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status',
        'order_number',
        'customer_id',
        'type',
        'package_dealers_id',
        'price',
        'vat',
        'net_price',
        'coupons_id',
        'coupons_rate',
        'coupons',
        'discount',
        'total',
        'accept',
        'full_receipt',
        'person_type',
        'full_name',
        'tax_id_no',
        'full_telephone',
        'full_email',
        'full_address',
        'full_province',
        'full_district',
        'full_subdistrict',
        'full_zipcode',
        'short_receipt',
        'short_name',
        'short_telephone',
        'short_email',
        'short_address',
        'short_province',
        'short_district',
        'short_subdistrict',
        'short_zipcode',
        'no_receipt',
        'donate',
        'donate_amount',
        'payment_method',
        'payment_date',
        'payment_status',
        'ref_1',
        'ref_2',
        'ref_3',
    ];

    protected $casts = [
        'accept' => 'boolean',
        'full_receipt' => 'boolean',
        'short_receipt' => 'boolean',
        'no_receipt' => 'boolean',
        'donate' => 'boolean',
        'payment_date' => 'datetime',
    ];
}
