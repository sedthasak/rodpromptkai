<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageDealerModel extends Model
{
    use HasFactory;

    protected $table = 'package_dealers';

    protected $fillable = [
        'name',
        'price',
        'old_price',
        'label_save',
        'label_bottom',
        'limit',
        'push',
        'coupon',
        'campaign',
        'text1',
        'text2',
        'text3',
        'text4',
        'text5',
        'text6',
    ];
}
