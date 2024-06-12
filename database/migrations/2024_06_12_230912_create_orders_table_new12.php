<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTableNew12 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->string('status'); // status
            $table->string('order_number'); // order_number
            $table->unsignedBigInteger('customer_id'); // customer_id relation to customer.id
            $table->string('type'); // type
            $table->foreignId('package_dealers_id')->nullable()->constrained('package_dealers')->onDelete('set null'); // package_dealers_id relation to package_dealers.id (nullable)
            $table->decimal('price', 8, 2); // price (decimal with 2 decimal points)
            $table->decimal('vat', 8, 2); // vat (decimal with 2 decimal points)
            $table->decimal('net_price', 8, 2); // net_price (decimal with 2 decimal points)
            $table->foreignId('coupons_id')->nullable()->constrained('coupons')->onDelete('set null'); // coupons_id relation to coupons.id (nullable)
            $table->decimal('coupons_rate', 8, 2)->nullable(); // coupons_rate (decimal with 2 decimal points, nullable)
            $table->string('coupons')->nullable(); // coupons (nullable string)
            $table->decimal('discount', 8, 2)->nullable(); // discount (decimal with 2 decimal points, nullable)
            $table->decimal('total', 8, 2); // total (decimal with 2 decimal points)
            $table->boolean('accept'); // accept (boolean)
            $table->boolean('full_receipt')->nullable(); // full_receipt (nullable boolean)
            $table->string('person_type')->nullable(); // person_type (nullable string)
            $table->string('full_name')->nullable(); // full_name (nullable string)
            $table->string('tax_id_no')->nullable(); // tax_id_no (nullable string)
            $table->string('full_telephone')->nullable(); // full_telephone (nullable string)
            $table->string('full_email')->nullable(); // full_email (nullable string)
            $table->string('full_address')->nullable(); // full_address (nullable string)
            $table->string('full_province')->nullable(); // full_province (nullable string)
            $table->string('full_district')->nullable(); // full_district (nullable string)
            $table->string('full_subdistrict')->nullable(); // full_subdistrict (nullable string)
            $table->string('full_zipcode')->nullable(); // full_zipcode (nullable string)
            $table->boolean('short_receipt')->nullable(); // short_receipt (nullable boolean)
            $table->string('short_name')->nullable(); // short_name (nullable string)
            $table->string('short_telephone')->nullable(); // short_telephone (nullable string)
            $table->string('short_email')->nullable(); // short_email (nullable string)
            $table->string('short_address')->nullable(); // short_address (nullable string)
            $table->string('short_province')->nullable(); // short_province (nullable string)
            $table->string('short_district')->nullable(); // short_district (nullable string)
            $table->string('short_subdistrict')->nullable(); // short_subdistrict (nullable string)
            $table->string('short_zipcode')->nullable(); // short_zipcode (nullable string)
            $table->boolean('no_receipt')->nullable(); // no_receipt (nullable boolean)
            $table->boolean('donate'); // donate (boolean)
            $table->decimal('donate_amount', 8, 2)->nullable(); // donate_amount (nullable decimal with 2 decimal points)
            $table->string('payment_method')->nullable(); // payment_method (nullable string)
            $table->timestamp('payment_date')->nullable(); // payment_date (nullable date)
            $table->string('payment_status')->nullable(); // payment_status (nullable string)
            $table->string('ref_1')->nullable(); // ref_1 (nullable string)
            $table->string('ref_2')->nullable(); // ref_2 (nullable string)
            $table->string('ref_3')->nullable(); // ref_3 (nullable string)
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
        Schema::dropIfExists('orders');
    }
}
