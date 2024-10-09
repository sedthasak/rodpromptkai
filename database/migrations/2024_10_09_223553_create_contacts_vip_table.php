<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsVipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_vip', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name');
            $table->string('phone');
            $table->string('line')->nullable(); // Optional field
            $table->string('business_name')->nullable(); // Optional field
            $table->timestamps(); // Created and Updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts_vip');
    }
}
