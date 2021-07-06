<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->text('invoice_no');
            $table->text('link_id');
            $table->date('invoice_date');
            $table->text('billing_address');
            $table->text('subject');
            $table->decimal('previous_due');
            $table->decimal('real_ip')->nullable();
            $table->decimal('core_rent')->nullable();
            $table->decimal('otc')->nullable();
            $table->decimal('vat')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
