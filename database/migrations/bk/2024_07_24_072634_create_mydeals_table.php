<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mydeals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cars_id')->nullable()->constrained('cars');
            $table->foreignId('customer_id')->constrained('customers');
            $table->dateTime('deal_register');
            $table->dateTime('deal_expire');
            $table->string('name')->nullable();
            $table->string('border')->nullable();
            $table->string('background')->nullable();
            $table->string('image_background')->nullable();
            $table->string('font1')->nullable();
            $table->string('font2')->nullable();
            $table->string('font3')->nullable();
            $table->string('topleft')->nullable();
            $table->string('bottomright')->nullable();
            $table->boolean('bigbrand')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mydeals');
    }
}
