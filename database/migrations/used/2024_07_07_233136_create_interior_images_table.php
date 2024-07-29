<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteriorImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interior_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('test_create_id');
            $table->string('path');
            $table->timestamps();

            $table->foreign('test_create_id')->references('id')->on('test_create')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interior_images');
    }
}
