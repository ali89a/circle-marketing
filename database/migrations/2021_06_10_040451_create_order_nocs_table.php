<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderNocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_nocs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->text('real_ip')->nullable();
            $table->text('status')->nullable();
            $table->text('mrtg_graph_url')->nullable();
            $table->string('username')->nullable();
            $table->text('password')->nullable();
            $table->text('device_description')->nullable();
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
        Schema::dropIfExists('order_nocs');
    }
}
