<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCustomerInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_customer_infos', function (Blueprint $table) {
            $table->id();
            $table->string('organization')->nullable();
            $table->text('client_type')->nullable();
            $table->text('occupation')->nullable();
            $table->string('technical_email')->nullable();
            $table->string('billing_email')->nullable();
            $table->text('mobile')->nullable();
            $table->text('alter_mobile')->nullable();
            $table->text('technical_address')->nullable();
            $table->text('billing_address')->nullable();
            $table->foreignId('customer_id')->nullable();
            $table->foreignId('order_id');
            $table->foreignId('division_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('upazila_id')->nullable();
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
        Schema::dropIfExists('order_customer_infos');
    }
}
