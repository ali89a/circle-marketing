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
            $table->foreignId('m_approved_by');
            $table->date('m_approved_time');
            $table->foreignId('a_approved_by');
            $table->date('a_approved_time');
            $table->foreignId('coo_approved_by');
            $table->date('coo_approved_time');
            $table->foreignId('noc_assigned_by');
            $table->date('noc_assigned_time');
            $table->foreignId('noc_approved_by');
            $table->date('noc_approved_time');
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
