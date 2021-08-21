<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderNocItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_noc_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); 
            $table->Integer('vlan')->nullable();
            $table->string('ip')->nullable();
            $table->Integer('assigned_brandwith')->nullable();
            $table->unsignedBigInteger('order_noc_id');
            $table->foreign('order_noc_id')->references('id')->on('order_nocs')->onDelete('cascade');
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
        Schema::dropIfExists('order_noc_items');
    }
}
