<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoDistrictsTable extends Migration
{
    public function up()
    {
        Schema::create('geo_districts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name_th');
            $table->string('name_en');
            $table->unsignedBigInteger('province_id');
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('geo_provinces')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('geo_districts');
    }
}
