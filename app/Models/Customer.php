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
        'dealerpack_quota',
        'dealerpack_regis',
        'dealerpack_expire',
        'vippack',
        'vippack_quota',
        'vippack_regis',
        'vippack_expire',
        'order_id',
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

    // Relationship with cars
    public function cars()
    {
        return $this->hasMany(carsModel::class, 'customer_id');
    }

    // Relationship with MyDeal
    public function myDeals()
    {
        return $this->hasMany(MyDeal::class, 'customer_id');
    }

    // Relationship with orders (a customer can have many orders)
    public function orders()
    {
        return $this->hasMany(OrderModel::class, 'customer_id');
    }

    /**
     * Update the visit history of the customer.
     *
     * @param int $postId
     * @return void
     */
    public function updateHistory($postId)
    {
        $history = $this->history ? json_decode($this->history, true) : [];
        
        // Remove the post if it already exists
        if (($key = array_search($postId, $history)) !== false) {
            unset($history[$key]);
        }

        // Add the new post to the beginning
        array_unshift($history, $postId);

        // Limit the history to the last 10 posts
        $history = array_slice($history, 0, 10);

        // Encode back to JSON and update the customer's history
        $this->history = json_encode($history);
        $this->save();
    }
}
