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
            $table->string('name');
            $table->string('organization_name');
            $table->text('client_type');
            $table->text('occupation');
            $table->string('email_technical');
            $table->string('email_billing');
            $table->text('mobile');
            $table->text('alter_mobile');
            $table->text('technical_address');
            $table->text('billing_address');
            $table->foreignId('customer_id');
            $table->foreignId('order_id');
            $table->foreignId('division_id');
            $table->foreignId('district_id');
            $table->foreignId('upazila_id');
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
