<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealerpackQuotaAndVippackQuotaToCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->integer('dealerpack_quota')->nullable()->after('dealerpack');
            $table->integer('vippack_quota')->nullable()->after('vippack');
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
            $table->dropColumn('dealerpack_quota');
            $table->dropColumn('vippack_quota');
        });
    }
}
