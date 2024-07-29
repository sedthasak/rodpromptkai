<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\contacts_backModel;

class noticeModel extends Model
{
    use HasFactory;

    protected $table = 'notice';

    protected $fillable = [
        'type',
        'status',
        'cars_id',
        'contacts_back_id',
        'customer_id',
        'title',
        'detail',
        'remark',
        'reference',
        'resource',
        'resource_id',
    ];

    protected $casts = [
        'cars_id' => 'integer',
        'contacts_back_id' => 'integer',
        'customer_id' => 'integer',
        'resource_id' => 'integer',
    ];

    public function contactBack()
    {
        return $this->belongsTo(contacts_backModel::class, 'contacts_back_id');
    }
}
