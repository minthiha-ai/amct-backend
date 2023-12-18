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
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('payment_photo')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('sub_total')->nullable();
            $table->integer('region_id')->nullable();
            $table->string('delivery_fee')->nullable();
            $table->integer('delivery_fee_id')->nullable();
            $table->string('grand_total')->nullable();
            $table->text('cancel_message')->nullable();
            $table->string('refund_date')->nullable();
            $table->text('refund_message')->nullable();
            $table->string('refund_image')->nullable();
            $table->string('status')->default('pending');
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