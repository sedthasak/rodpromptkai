<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestCreateUploadsTable extends Migration
{
    public function up()
    {
        Schema::create('test_create_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_create_id');
            $table->foreign('test_create_id')->references('id')->on('test_create')->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_create_uploads');
    }
}
