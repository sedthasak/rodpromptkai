<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTablenew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // name
            $table->string('border')->default('#000'); // border with default value
            $table->string('background')->default('#000'); // background with default value
            $table->string('image_background')->nullable(); // image_background (nullable string)
            $table->string('font1')->default('#000'); // font1 with default value
            $table->string('font2')->default('#000'); // font2 with default value
            $table->string('font3')->default('#000'); // font3 with default value
            $table->string('topleft')->nullable(); // topleft string
            $table->string('bottomright')->nullable(); // bottomright string
            $table->timestamp('expire')->nullable(); // exp timestamp
            $table->boolean('bigbrand')->nullable(); // bigbrand boolean
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deals');
    }
}
