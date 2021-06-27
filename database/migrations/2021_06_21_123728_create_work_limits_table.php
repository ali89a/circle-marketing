<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id');
            $table->integer('newclient')->nullable();
            $table->integer('followupclient')->nullable();
            $table->integer('reconnectclient')->nullable();
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
        Schema::dropIfExists('work_limits');
    }
}