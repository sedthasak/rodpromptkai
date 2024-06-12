<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealerPackagesTablenew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_dealers', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // name
            $table->decimal('price', 8, 2); // price (decimal with 2 decimal points)
            $table->decimal('old_price', 8, 2)->nullable(); // old_price (decimal with 2 decimal points)
            $table->string('label_save')->nullable(); // label_save
            $table->string('label_bottom')->nullable(); // label_bottom
            $table->integer('limit'); // limit (integer)
            $table->string('push')->nullable(); // push (nullable string)
            $table->string('coupon')->nullable(); // coupon (nullable string)
            $table->string('campaign')->nullable(); // campaign (nullable string)
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
        Schema::dropIfExists('package_dealers');
    }
}
