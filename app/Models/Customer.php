<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\carsModel;
use App\Models\MyDeal;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer'; // Ensure this matches your table name

    protected $fillable = [
        'phone',
        'sp_role',
        'role',
        'customer_quota',
        'dealerpack',
        'dealerpack_regis',
        'dealerpack_expire',
        'vippack',
        'vippack_regis',
        'vippack_expire',
        'accumulate',
        'username',
        'email',
        'image',
        'firstname',
        'lastname',
        'place',
        'province',
        'map',
        'google_map',
        'facebook',
        'line',
        'last_action',
        'bigbrand',
        'history',
        'remember',
        'created_at',
        'updated_at'
    ];

    public function cars()
    {
        return $this->hasMany(carsModel::class, 'customer_id');
    }

    public function myDeals()
    {
        return $this->hasMany(MyDeal::class, 'customer_id');
    }
}
