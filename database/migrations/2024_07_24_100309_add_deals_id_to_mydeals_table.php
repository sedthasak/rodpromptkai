<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealsIdToMydealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mydeals', function (Blueprint $table) {
            $table->unsignedBigInteger('deals_id')->after('id');

            // Adding foreign key constraint
            $table->foreign('deals_id')->references('id')->on('deals')->onDelete('cascade');
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
            $table->dropForeign(['deals_id']);
            $table->dropColumn('deals_id');
        });
    }
}
