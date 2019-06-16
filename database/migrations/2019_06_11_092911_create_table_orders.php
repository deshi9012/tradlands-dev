<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('orders', function (Blueprint $table) {

            //Shopify data
            $table->bigIncrements('id');
            $table->bigInteger('shopify_id');
            $table->string('shopify_email')->nullable();
            $table->string('shopify_phone')->nullable();
            $table->string('shopify_total_price');
            $table->string('shopify_order_number');
            $table->string('shopify_total_weight');
            $table->text('shopify_line_items');//json object as string
            $table->text('shopify_shipping_address');//json object as string
            $table->text('shopify_billing_address');//json object as string
            $table->decimal('shopify_order_weight', 10, 2);
            $table->string('shipify_order_units')->default('grams');
            $table->text('shopify_all_order');//json object as string
            //EasyPost data

            $table->text('easypost_to_address');//json object as string
            $table->text('easypost_from_address');//json object as string
            $table->string('predefined_package');
            $table->decimal('easypost_parcel_weight',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('orders');
    }
}
