<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoProvincesTable extends Migration
{
    public function up()
    {
        Schema::create('geo_provinces', function (Blueprint $table) {
            $table->id();
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedBigInteger('geography_id')->nullable(); // Optional field
            $table->timestamps(); // Includes created_at, updated_at, and deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('geo_provinces');
    }
}
