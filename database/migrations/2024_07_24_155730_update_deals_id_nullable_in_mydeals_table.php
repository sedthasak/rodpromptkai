<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDealsIdNullableInMydealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mydeals', function (Blueprint $table) {
            // Change deals_id to be nullable
            $table->unsignedBigInteger('deals_id')->nullable()->change();
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
            // Revert deals_id to not nullable
            $table->unsignedBigInteger('deals_id')->nullable(false)->change();
        });
    }
}
