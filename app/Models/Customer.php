<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table = 'customer';
    // protected $primaryKey = 'position_id';
    // public $incrementing = false;
    // protected $keyType = 'string';
    protected $fillable = [
        'phone', 
        'sp_role', 
        'username',
        'email',
        'remember',
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
        'history'
    ];
}