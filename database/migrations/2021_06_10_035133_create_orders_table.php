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
            $table->text('type')->nullable();
            $table->text('price')->nullable();
            $table->text('scl_id')->nullable();
            $table->text('gmap_location')->nullable();
            $table->text('connect_type')->nullable();
            $table->text('link_id')->nullable();
            $table->decimal('vat')->nullable();
            $table->date('order_submission_date')->nullable();
            $table->text('billing_cycle')->nullable();
            $table->text('billing_remark')->nullable();
            $table->text('bill_start_date')->nullable();
            $table->text('delivery_date')->nullable();
            $table->text('bill_generate_method')->nullable();
            $table->decimal('total_Price')->nullable();
            $table->text('core_rent')->nullable();
            $table->text('otc')->nullable();
            $table->text('real_ip')->nullable();
            $table->text('visit_type')->nullable();
            $table->text('security_money_type')->nullable();
            $table->text('security_money_amount')->nullable();
            $table->foreignId('marketing_user_id')->nullable();
            $table->foreignId('accounts_user_id')->nullable();
            $table->foreignId('customer_id')->nullable();
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
