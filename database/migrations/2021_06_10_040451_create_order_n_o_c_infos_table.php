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
            $table->text('real_ip');
            $table->text('vlan_internet');
            $table->text('ip_internet');
            $table->text('assigned_bandwidth');
            $table->text('vlan_ggc');
            $table->text('ip_ggc');
            $table->text('assigned_bandwidth_ggc');
            $table->text('vlan_fb');
            $table->text('ip_fb');
            $table->text('assigned_bandwidth_fb');
            $table->text('vlan_bdix');
            $table->text('ip_bdix');
            $table->text('assigned_bandwidth_bdix');
            $table->text('vlan_data');
            $table->text('ip_data');
            $table->text('assigned_bandwidth_data');
            $table->text('status');
            $table->text('mrtg_graph_url');
            $table->string('user_name');
            $table->text('password');
            $table->text('device_description');
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
