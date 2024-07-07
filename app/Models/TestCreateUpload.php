<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TestCreate;

class TestCreateUpload extends Model
{
    use HasFactory;
    
    protected $table = 'test_create_uploads';

    protected $fillable = [
        'test_create_id', 'path',
    ];

    // Relationships
    public function testCreate()
    {
        return $this->belongsTo(TestCreate::class, 'test_create_id');
    }
}
