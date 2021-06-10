<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_infos', function (Blueprint $table) {
            $table->id();
            $table->text('internet_capacity_1');
            $table->text('internet_price_1');
            $table->text('bdix_capacity_1');
            $table->text('bdix_price_1');
            $table->text('youtube_capacity_1');
            $table->text('youtube_price_1');
            $table->text('data_capacity_1');
            $table->text('data_price_1');
            $table->text('facebook_capacity_1');
            $table->text('facebook_price_1');
            $table->text('internet_capacity_2');
            $table->text('internet_price_2');
            $table->text('bdix_capacity_2');
            $table->text('bdix_price_2');
            $table->text('youtube_capacity_2');
            $table->text('youtube_price_2');
            $table->text('data_capacity_2');
            $table->text('data_price_2');
            $table->text('facebook_capacity_2');
            $table->text('facebook_price_2');
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
        Schema::dropIfExists('order_infos');
    }
}
