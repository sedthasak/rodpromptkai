<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestCreate;

class ExteriorImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_create_id',
        'path',
    ];

    public function testCreate()
    {
        return $this->belongsTo(TestCreate::class);
    }
}