<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id');
            $table->bigInteger('support_id')->nullable();
            $table->string('customer_email');
            $table->text('cc_recipents')->nullable();
            $table->string('title');
            $table->text('problem_details');
            $table->text('attachment')->nullable();
            $table->foreignId('status_id');
            $table->foreignId('priority_id');
            $table->foreignId('category_id');
            $table->foreignId('department')->nullable();
            $table->string('tokenhas')->nullable();
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
        Schema::dropIfExists('support_tickets');
    }
}
