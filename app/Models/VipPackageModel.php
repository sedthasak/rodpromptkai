<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VipPackageModel extends Model
{
    use HasFactory;

    protected $table = 'package_vips';

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'label_save',
        'label_bottom',
        'limit',
    ];
}
