<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCustomerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_customer_documents', function (Blueprint $table) {
            $table->id();
            $table->text('work_order')->nullable();
            $table->text('authorization')->nullable();
            $table->text('ip_agreement')->nullable();
            $table->text('noc')->nullable();
            $table->foreignId('order_id');
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
        Schema::dropIfExists('order_customer_documents');
    }
}
