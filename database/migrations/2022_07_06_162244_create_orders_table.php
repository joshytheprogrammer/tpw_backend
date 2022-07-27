<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('customer_id')->unique();
            $table->json('products')->comment('A list of the id of the products ordered');
            $table->integer('amount');
            $table->string('status')->comment('the status of the order [awaiting_payment, pending, awaiting_delivery/pickup, successful or cancelled]');
            $table->string('payment_mode')->comment('online or offline');
            $table->string('fulfillment')->comment('pickup or delivery');
            $table->timestamps();
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
};
