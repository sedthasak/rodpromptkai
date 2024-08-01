<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTopleftPositionToDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->tinyInteger('topleft_position')->nullable()->default(1)->after('topleft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deals', function (Blueprint $table) {
            $table->dropColumn('topleft_position');
        });
    }
}
