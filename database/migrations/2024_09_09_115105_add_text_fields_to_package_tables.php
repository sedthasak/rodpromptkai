<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTextFieldsToPackageTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update package_dealers table
        Schema::table('package_dealers', function (Blueprint $table) {
            $table->string('text1')->nullable()->after('campaign');
            $table->string('text2')->nullable()->after('text1');
            $table->string('text3')->nullable()->after('text2');
            $table->string('text4')->nullable()->after('text3');
            $table->string('text5')->nullable()->after('text4');
            $table->string('text6')->nullable()->after('text5');
        });

        // Update package_vips table
        Schema::table('package_vips', function (Blueprint $table) {
            $table->string('text1')->nullable()->after('limit');
            $table->string('text2')->nullable()->after('text1');
            $table->string('text3')->nullable()->after('text2');
            $table->string('text4')->nullable()->after('text3');
            $table->string('text5')->nullable()->after('text4');
            $table->string('text6')->nullable()->after('text5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('package_dealers', function (Blueprint $table) {
            $table->dropColumn(['text1', 'text2', 'text3', 'text4', 'text5', 'text6']);
        });

        Schema::table('package_vips', function (Blueprint $table) {
            $table->dropColumn(['text1', 'text2', 'text3', 'text4', 'text5', 'text6']);
        });
    }
}
