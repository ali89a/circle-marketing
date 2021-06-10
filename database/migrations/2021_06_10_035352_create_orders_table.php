<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('type');
            $table->text('scl_id');
            $table->text('gmap_location');
            $table->text('connect_type');
            $table->text('link_id');
            $table->decimal('vat');
            $table->date('order_submission_date');
            $table->text('billing_cycle');
            $table->text('billing_remark');
            $table->text('bill_start_date');
            $table->text('delivery_date');
            $table->text('bill_generate_method');
            $table->decimal('total_Price');
            $table->text('core_rent');
            $table->text('otc');
            $table->text('real_ip');
            $table->foreignId('marketing_user_id');
            $table->text('accounts_user_id');
            $table->text('security_money_type');
            $table->text('security_money_amount');
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
        Schema::dropIfExists('orders');
    }
}
