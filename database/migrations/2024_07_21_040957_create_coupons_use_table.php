<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsUseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons_use', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupons_id');
            $table->string('name');
            $table->string('code');
            $table->decimal('rate', 8, 2);
            $table->decimal('limit_rate', 8, 2)->nullable();
            $table->unsignedBigInteger('orders_id');
            $table->decimal('total', 8, 2);
            $table->decimal('discount', 8, 2);
            $table->timestamps();

            $table->foreign('coupons_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons_use');
    }
}
