<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAccumulateColumnInCustomerTable extends Migration
{
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->renameColumn('Accumulate', 'accumulate');
        });
    }

    public function down()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->renameColumn('accumulate', 'Accumulate');
        });
    }
}
