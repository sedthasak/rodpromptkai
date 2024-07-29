<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\brandsModel;
use App\Models\modelsModel;
use App\Models\generationsModel;
use App\Models\sub_modelsModel;
use App\Models\User;
use App\Models\Customer;
use App\Models\MyDeal;

class carsModel extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'title',
        'feature',
        'brand_id',
        'model_id',
        'generations_id',
        'sub_models_id',
        'modelyear',
        'yearregis',
        'vehicle_code',
        'gear',
        'color',
        'price',
        'old_price',
        'province',
        'gas',
        'ev',
        'user_id',
        'customer_id',
        'mileage',
        'mappicture',
        'location',
        'clickcount',
        'viewcount',
        'seecount',
        'adddate',
        'approvedate',
        'expiredate',
        'stock',
        'type',
        'promotion_id',
        'status',
        'payment',
        'detail',
        'reserve',
        'licenseplate',
        'warranty_1',
        'warranty_2',
        'warranty_3',
        'warranty_2_input',
        'category',
        'tag',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'mydeals'  // Add the new field here
    ];

    public function brand()
    {
        return $this->belongsTo(brandsModel::class, 'brand_id');
    }

    public function model()
    {
        return $this->belongsTo(modelsModel::class, 'model_id');
    }

    public function generation()
    {
        return $this->belongsTo(generationsModel::class, 'generations_id');
    }

    public function subModel()
    {
        return $this->belongsTo(sub_modelsModel::class, 'sub_models_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function myDeal()
    {
        return $this->hasOne(MyDeal::class, 'cars_id');
    }

}
