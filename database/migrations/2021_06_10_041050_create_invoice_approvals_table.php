<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('invoice_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->nullable();
            $table->foreignId('invoice_id')->nullable();

            $table->foreignId('noc_approved_by')->nullable();
            $table->date('noc_approved_time')->nullable();
            $table->enum('noc_approved_status',['Pending','Approved','Cancle'])->default('Pending');

            $table->foreignId('m_approved_by')->nullable();
            $table->date('m_approved_time')->nullable();
            $table->enum('m_approved_status',['Pending','Approved','Cancle'])->default('Pending');

            $table->foreignId('a_approved_by')->nullable();
            $table->date('a_approved_time')->nullable();
            $table->enum('a_approved_status',['Pending','Approved','Cancle'])->default('Pending');
            
            $table->foreignId('coo_approved_by')->nullable();
            $table->date('coo_approved_time')->nullable();
            $table->enum('coo_approved_status',['Pending','Approved','Cancle'])->default('Pending');
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
        Schema::dropIfExists('invoice_approvals');
    }
}
