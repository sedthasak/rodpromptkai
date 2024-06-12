<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTablenew extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('name'); // name
            $table->string('code'); // code
            $table->decimal('rate', 8, 2); // rate (decimal with 2 decimal points)
            $table->decimal('limit_rate', 8, 2); // limit_rate (decimal with 2 decimal points)
            $table->timestamp('expire'); // expire (expiration date)
            $table->text('description')->nullable(); // description (nullable)
            $table->integer('limit')->nullable(); // limit (nullable)
            $table->string('status')->nullable(); // status (text)
            $table->foreignId('level_member')->nullable()->constrained('levels')->nullOnDelete();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
