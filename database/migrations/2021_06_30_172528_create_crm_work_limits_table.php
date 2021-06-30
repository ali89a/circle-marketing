<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrmWorkLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crm_work_limits', function (Blueprint $table) {
            $table->id();
            $table->integer('blimit')->nullable();
            $table->integer('mlimit')->nullable();
            $table->integer('climit')->nullable();
            $table->integer('llimit')->nullable();
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
        Schema::dropIfExists('crm_work_limits');
    }
}