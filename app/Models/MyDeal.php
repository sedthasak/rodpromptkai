<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\carsModel;
use App\Models\Customer;
use App\Models\DealModel;
use App\Models\OrderModel;

class MyDeal extends Model
{
    use HasFactory;

    protected $table = 'mydeals';

    protected $fillable = [
        'cars_id',
        'customer_id',
        'deal_register',
        'deal_expire',
        'name',
        'border',
        'background',
        'image_background',
        'font1',
        'font2',
        'font3',
        'topleft',
        'bottomright',
        'bigbrand',
        'deals_id',
        'orders_id', // Add orders_id to the fillable array
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function car()
    {
        return $this->belongsTo(carsModel::class, 'cars_id');
    }

    public function deal()
    {
        return $this->belongsTo(DealModel::class, 'deals_id');
    }

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'orders_id'); // Define the relationship to OrderModel
    }
}
