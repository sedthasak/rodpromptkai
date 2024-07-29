<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ReorderColumnsInCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
            $table->enum('sp_role', ['home','dealer','lady'])->default('home')->change();
            $table->enum('role', ['normal','dealer','vip','admin'])->default('normal')->change();
            $table->integer('customer_quota')->default(0)->change();
            $table->string('dealerpack')->nullable()->change();
            $table->timestamp('dealerpack_regis')->nullable()->change();
            $table->timestamp('dealerpack_expire')->nullable()->change();
            $table->string('vippack')->nullable()->change();
            $table->timestamp('vippack_regis')->nullable()->change();
            $table->timestamp('vippack_expire')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('username')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->longText('image')->nullable()->change();
            $table->string('firstname')->nullable()->change();
            $table->string('lastname')->nullable()->change();
            $table->longText('place')->nullable()->change();
            $table->longText('province')->nullable()->change();
            $table->longText('map')->nullable()->change();
            $table->longText('google_map')->nullable()->change();
            $table->longText('facebook')->nullable()->change();
            $table->longText('line')->nullable()->change();
            $table->timestamp('last_action')->nullable()->change();
            $table->string('bigbrand')->nullable()->change();
            $table->longText('history')->nullable()->change();
            $table->longText('remember')->nullable()->change();
            $table->timestamps();
        });

        // Raw SQL to reorder columns
        DB::statement("
            ALTER TABLE `customer`
            MODIFY COLUMN `id` bigint(20) UNSIGNED NOT NULL FIRST,
            MODIFY COLUMN `sp_role` enum('home','dealer','lady') NOT NULL DEFAULT 'home' AFTER `id`,
            MODIFY COLUMN `role` enum('normal','dealer','vip','admin') NOT NULL DEFAULT 'normal' AFTER `sp_role`,
            MODIFY COLUMN `customer_quota` int(11) DEFAULT 0 AFTER `role`,
            MODIFY COLUMN `dealerpack` varchar(255) DEFAULT NULL AFTER `customer_quota`,
            MODIFY COLUMN `dealerpack_regis` timestamp NULL DEFAULT NULL AFTER `dealerpack`,
            MODIFY COLUMN `dealerpack_expire` timestamp NULL DEFAULT NULL AFTER `dealerpack_regis`,
            MODIFY COLUMN `vippack` varchar(255) DEFAULT NULL AFTER `dealerpack_expire`,
            MODIFY COLUMN `vippack_regis` timestamp NULL DEFAULT NULL AFTER `vippack`,
            MODIFY COLUMN `vippack_expire` timestamp NULL DEFAULT NULL AFTER `vippack_regis`,
            MODIFY COLUMN `phone` varchar(255) DEFAULT NULL AFTER `vippack_expire`,
            MODIFY COLUMN `username` varchar(255) DEFAULT NULL AFTER `phone`,
            MODIFY COLUMN `email` varchar(255) DEFAULT NULL AFTER `username`,
            MODIFY COLUMN `image` longtext DEFAULT NULL AFTER `email`,
            MODIFY COLUMN `firstname` varchar(255) DEFAULT NULL AFTER `image`,
            MODIFY COLUMN `lastname` varchar(255) DEFAULT NULL AFTER `firstname`,
            MODIFY COLUMN `place` longtext DEFAULT NULL AFTER `lastname`,
            MODIFY COLUMN `province` longtext DEFAULT NULL AFTER `place`,
            MODIFY COLUMN `map` longtext DEFAULT NULL AFTER `province`,
            MODIFY COLUMN `google_map` longtext DEFAULT NULL AFTER `map`,
            MODIFY COLUMN `facebook` longtext DEFAULT NULL AFTER `google_map`,
            MODIFY COLUMN `line` longtext DEFAULT NULL AFTER `facebook`,
            MODIFY COLUMN `last_action` timestamp NULL DEFAULT NULL AFTER `line`,
            MODIFY COLUMN `bigbrand` varchar(255) DEFAULT NULL AFTER `last_action`,
            MODIFY COLUMN `history` longtext DEFAULT NULL AFTER `bigbrand`,
            MODIFY COLUMN `remember` longtext DEFAULT NULL AFTER `history`,
            MODIFY COLUMN `created_at` timestamp NULL DEFAULT NULL AFTER `remember`,
            MODIFY COLUMN `updated_at` timestamp NULL DEFAULT NULL AFTER `created_at`
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // No need to revert the column order in the down method
    }
}
