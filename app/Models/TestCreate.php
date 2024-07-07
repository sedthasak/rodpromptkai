<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\TestCreateUpload;

class TestCreate extends Model
{
    use HasFactory;

    protected $table = 'test_create';

    protected $fillable = [
        'number',
    ];

    // Define the one-to-many relationship with TestCreateUpload
    public function uploads()
    {
        return $this->hasMany(TestCreateUpload::class, 'test_create_id');
    }
}
