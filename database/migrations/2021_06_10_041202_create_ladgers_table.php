<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLadgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ladgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->decimal('previous_due');
            $table->decimal('monthly_bill');
            $table->decimal('monthly_paid');
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
        Schema::dropIfExists('ladgers');
    }
}
