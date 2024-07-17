<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomerQuotaDefaultValue extends Migration
{
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->integer('customer_quota')->default(3)->change();
        });
    }

    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->integer('customer_quota')->default(0)->change(); // Adjust default value if needed
        });
    }
}
