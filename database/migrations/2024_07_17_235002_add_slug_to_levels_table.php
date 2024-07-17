<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToLevelsTable extends Migration
{
    public function up()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->string('slug')->after('name')->nullable(false); // Adding 'slug' field after 'name', not nullable
        });
    }

    public function down()
    {
        Schema::table('levels', function (Blueprint $table) {
            $table->dropColumn('slug'); // Drop 'slug' column if rolling back migration
        });
    }
}
