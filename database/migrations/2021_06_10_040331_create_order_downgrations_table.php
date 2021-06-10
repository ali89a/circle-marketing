<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDowngrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_downgrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');           
            $table->text('internet_capacity_1');          
            $table->text('bdix_capacity_1');           
            $table->text('youtube_capacity_1');
            $table->text('facebook_capacity_1');
            $table->text('data_capacity_1');          
            $table->text('internet_capacity_2');
            $table->text('bdix_capacity_2');
            $table->text('youtube_capacity_2');
            $table->text('facebook_capacity_2');
            $table->text('data_capacity_2');
            $table->date('delivery_date');
            $table->text('status');
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
        Schema::dropIfExists('order_downgrations');
    }
}
