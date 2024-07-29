<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNoticeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notice', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('notice', 'type')) {
                $table->string('type')->nullable()->after('id');
            }
            if (!Schema::hasColumn('notice', 'cars_id')) {
                $table->unsignedBigInteger('cars_id')->nullable()->after('type');
            }
            if (!Schema::hasColumn('notice', 'contacts_back_id')) {
                $table->unsignedBigInteger('contacts_back_id')->nullable()->after('cars_id');
            }
            if (!Schema::hasColumn('notice', 'remark')) {
                $table->text('remark')->nullable()->after('contacts_back_id');
            }
            if (!Schema::hasColumn('notice', 'reference')) {
                $table->text('reference')->nullable()->after('remark');
            }

            // Update existing columns
            $table->text('resource')->nullable()->change();
            $table->integer('resource_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notice', function (Blueprint $table) {
            // Drop new columns if they exist
            if (Schema::hasColumn('notice', 'type')) {
                $table->dropColumn('type');
            }
            if (Schema::hasColumn('notice', 'cars_id')) {
                $table->dropColumn('cars_id');
            }
            if (Schema::hasColumn('notice', 'contacts_back_id')) {
                $table->dropColumn('contacts_back_id');
            }
            if (Schema::hasColumn('notice', 'remark')) {
                $table->dropColumn('remark');
            }
            if (Schema::hasColumn('notice', 'reference')) {
                $table->dropColumn('reference');
            }

            // Revert column changes to their original state
            $table->text('resource')->change();
            $table->integer('resource_id')->change();
        });
    }
}
