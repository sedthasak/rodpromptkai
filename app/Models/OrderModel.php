<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\MyDeal;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'status',
        'order_number',
        'customer_id',
        'type',
        'amount', // Add the amount field here
        'package_dealers_id',
        'price',
        'vat',
        'coupons_id',
        'coupons_rate',
        'coupons',
        'discount',
        'net_price',
        'donate',
        'donation',
        'total',
        'accept',
        'invoiceform',
        'full_receipt',
        'person_type',
        'individual_name',
        'individual_taxidno',
        'individual_telephone',
        'individual_email',
        'individual_address',
        'individual_province',
        'individual_district',
        'individual_subdistrict',
        'individual_zipcode',
        'corporation_name',
        'corporation_taxidno',
        'corporation_branch',
        'corporation_branchid',
        'corporation_telephone',
        'corporation_email',
        'corporation_address',
        'corporation_province',
        'corporation_district',
        'corporation_subdistrict',
        'corporation_zipcode',
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
    // Relationship with MyDeal
    public function myDeals()
    {
        return $this->hasMany(MyDeal::class, 'orders_id');
    }
}
