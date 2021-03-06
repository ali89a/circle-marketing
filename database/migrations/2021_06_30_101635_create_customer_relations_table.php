<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicantname');
            $table->text('workOrder')->nullable();
            $table->text('createdBy');
            $table->text('uplink');
            $table->enum('issue_type', ['no_issue', 'not_responding', 'marketing', 'fiber', 'support', 'account']);
            $table->enum('client_type', ['bandwidth', 'mac', 'corporate']);
            $table->date('start_date');
            $table->text('issue_details');
            $table->string('user');
            $table->text('remark');
            // $table->text('rating');
            $table->enum('rating', ['solved', 'not_solved'])->nullable();
            $table->enum('feedback', ['0', '1', '2', '3', '4'])->nullable();
            // $table->text('feedback')->nullable();
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
        Schema::dropIfExists('customer_relations');
    }
}