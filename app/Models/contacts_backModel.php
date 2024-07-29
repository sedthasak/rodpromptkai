<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\carsModel;
use App\Models\noticeModel;

class contacts_backModel extends Model
{
    use HasFactory;

    protected $table = 'contacts_back';

    protected $fillable = [
        'customer_id',
        'name',
        'tel',
        'time',
        'remark',
        'cars_id',
        'status',
    ];

    public function car()
    {
        return $this->belongsTo(carsModel::class, 'cars_id');
    }

    public function notices()
    {
        return $this->hasMany(noticeModel::class, 'contacts_back_id');
    }
}
