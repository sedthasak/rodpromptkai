<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrdersIdToMydealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mydeals', function (Blueprint $table) {
            $table->unsignedBigInteger('orders_id')->after('customer_id')->nullable();
            
            // If you have foreign keys set up, you can add this:
            // $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mydeals', function (Blueprint $table) {
            $table->dropColumn('orders_id');
            
            // If you added a foreign key, drop it as well:
            // $table->dropForeign(['orders_id']);
        });
    }
}

