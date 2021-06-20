<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('m_approved_by')->nullable();
            $table->date('m_approved_time')->nullable();
            $table->text('m_approved_status')->nullable();
            $table->foreignId('a_approved_by')->nullable();
            $table->date('a_approved_time')->nullable();
            $table->text('a_approved_status')->nullable();
            $table->foreignId('coo_approved_by')->nullable();
            $table->date('coo_approved_time')->nullable();
            $table->text('coo_approved_status')->nullable();
            $table->foreignId('noc_assigned_by')->nullable();
            $table->date('noc_assigned_time')->nullable();
            $table->text('noc_assigned_status')->nullable();
            $table->date('noc_done_time')->nullable();
            $table->foreignId('noc_approved_by')->nullable();
            $table->date('noc_approved_time')->nullable();
            $table->text('noc_approved_status')->nullable();
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
        Schema::dropIfExists('order_approvals');
    }
}
