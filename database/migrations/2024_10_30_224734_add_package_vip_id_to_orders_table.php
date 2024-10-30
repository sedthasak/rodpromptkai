<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageVipIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('package_vip_id')->nullable()->after('package_dealers_id');
            
            // If you want to set up a foreign key, you can uncomment the following line
            // $table->foreign('package_vip_id')->references('id')->on('package_vips')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('package_vip_id');
            
            // If a foreign key was added, also drop it here
            // $table->dropForeign(['package_vip_id']);
        });
    }
}
