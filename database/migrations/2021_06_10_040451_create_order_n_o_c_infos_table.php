<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderNOCInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_n_o_c_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->text('real_ip')->nullable();
            $table->text('vlan_internet')->nullable();
            $table->text('ip_internet')->nullable();
            $table->text('assigned_bandwidth')->nullable();
            $table->text('vlan_ggc')->nullable();
            $table->text('ip_ggc')->nullable();
            $table->text('assigned_bandwidth_ggc')->nullable();
            $table->text('vlan_fb')->nullable();
            $table->text('ip_fb')->nullable();
            $table->text('assigned_bandwidth_fb')->nullable();
            $table->text('vlan_bdix')->nullable();
            $table->text('ip_bdix')->nullable();
            $table->text('assigned_bandwidth_bdix')->nullable();
            $table->text('vlan_data')->nullable();
            $table->text('ip_data')->nullable();
            $table->text('assigned_bandwidth_data')->nullable();
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
        Schema::dropIfExists('order_n_o_c_infos');
    }
}
