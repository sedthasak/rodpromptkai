<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoSubDistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('geo_sub_districts', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code');
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedBigInteger('district_id');
            $table->timestamps(); // Includes created_at, updated_at, and deleted_at

            $table->foreign('district_id')->references('id')->on('geo_districts')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('geo_sub_districts');
    }
}
