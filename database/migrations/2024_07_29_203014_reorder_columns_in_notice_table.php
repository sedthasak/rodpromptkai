<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ReorderColumnsInNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create a new table with the desired column order
        Schema::create('new_notice', function (Blueprint $table) {
            $table->id(); // id column
            $table->string('type')->nullable();
            $table->longText('status')->nullable();
            $table->unsignedBigInteger('cars_id')->nullable();
            $table->unsignedBigInteger('contacts_back_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('detail')->nullable();
            $table->text('remark')->nullable();
            $table->text('reference')->nullable();
            $table->text('resource')->nullable();
            $table->integer('resource_id')->nullable();
            $table->timestamps();
        });

        // Copy data from the old table to the new table
        DB::statement('INSERT INTO new_notice (id, type, status, cars_id, contacts_back_id, customer_id, title, detail, remark, reference, resource, resource_id, created_at, updated_at)
                        SELECT id, type, status, cars_id, contacts_back_id, customer_id, title, detail, remark, reference, resource, resource_id, created_at, updated_at
                        FROM notice');

        // Drop the old table
        Schema::dropIfExists('notice');

        // Rename the new table to the original table name
        Schema::rename('new_notice', 'notice');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Create the old table structure
        Schema::create('old_notice', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('cars_id')->nullable();
            $table->unsignedBigInteger('contacts_back_id')->nullable();
            $table->text('remark')->nullable();
            $table->text('reference')->nullable();
            $table->integer('customer_id');
            $table->longText('status')->nullable();
            $table->longText('title')->nullable();
            $table->longText('detail')->nullable();
            $table->text('resource')->nullable();
            $table->integer('resource_id')->nullable();
            $table->timestamps();
        });

        // Copy data back if necessary
        DB::statement('INSERT INTO old_notice (id, type, cars_id, contacts_back_id, remark, reference, customer_id, status, title, detail, resource, resource_id, created_at, updated_at)
                        SELECT id, type, cars_id, contacts_back_id, remark, reference, customer_id, status, title, detail, resource, resource_id, created_at, updated_at
                        FROM notice');

        // Drop the new table
        Schema::dropIfExists('notice');

        // Rename the old table to the original table name
        Schema::rename('old_notice', 'notice');
    }
}
