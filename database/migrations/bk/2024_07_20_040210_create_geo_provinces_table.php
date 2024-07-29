<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGeoProvincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geo_provinces', function (Blueprint $table) {
            $table->id(); // Automatically creates an `id` column with auto-increment and primary key
            $table->string('code', 2);
            $table->string('name_th', 150);
            $table->string('name_en', 150);
            $table->integer('geography_id')->default(0);
            $table->timestamps(); // Optional, for created_at and updated_at columns
        });

        // Insert initial data
        DB::table('geo_provinces')->insert([
            ['id' => 1, 'code' => '10', 'name_th' => 'กรุงเทพมหานคร', 'name_en' => 'Bangkok', 'geography_id' => 2],
            ['id' => 2, 'code' => '11', 'name_th' => 'สมุทรปราการ', 'name_en' => 'Samut Prakan', 'geography_id' => 2],
            ['id' => 3, 'code' => '12', 'name_th' => 'นนทบุรี', 'name_en' => 'Nonthaburi', 'geography_id' => 2],
            // Add more data as needed
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_provinces');
    }
}
