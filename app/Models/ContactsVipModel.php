<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactsVipModel extends Model
{
    use HasFactory;

    protected $table = 'contacts_vip';

    protected $fillable = [
        'name',
        'phone',
        'line',
        'business_name',
    ];
}
