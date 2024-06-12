<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelsTablenew2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // name
            $table->integer('accumulate'); // accumulate
            $table->string('coupon')->nullable(); // coupon (nullable string)
            $table->string('color')->nullable(); // color (nullable string)
            $table->string('ref')->nullable(); // color (nullable string)
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
        Schema::dropIfExists('levels');
    }
}
