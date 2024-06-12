<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->integer('customer_quota')->default(0)->nullable(); // customer_quota with default value of 0 and nullable
            $table->string('dealerpack')->nullable(); // dealerpack (nullable string)
            $table->timestamp('dealerpack_regis')->nullable(); // dealerpack_regis (nullable timestamp)
            $table->timestamp('dealerpack_expire')->nullable(); // dealerpack_expire (nullable timestamp)
            $table->string('vippack')->nullable(); // vippack (nullable string)
            $table->timestamp('vippack_regis')->nullable(); // vippack_regis (nullable timestamp)
            $table->timestamp('vippack_expire')->nullable(); // vippack_expire (nullable timestamp)
            $table->string('bigbrand')->nullable(); // bigbrand (nullable string)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->dropColumn('customer_quota');
            $table->dropColumn('dealerpack');
            $table->dropColumn('dealerpack_regis');
            $table->dropColumn('dealerpack_expire');
            $table->dropColumn('vippack');
            $table->dropColumn('vippack_regis');
            $table->dropColumn('vippack_expire');
            $table->dropColumn('bigbrand');
        });
    }
}
