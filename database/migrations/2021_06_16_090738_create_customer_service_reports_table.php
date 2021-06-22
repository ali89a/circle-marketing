<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerServiceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_service_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_report_id');
            $table->text('visit_phone');
            $table->text('ctype');
            $table->text('isp_type')->nullable();
            $table->text('visiting_card')->nullable();
            $table->decimal('bandwidth');
            $table->decimal('rate');
            $table->decimal('otc');
            $table->text('remark');
            $table->text('audio')->nullable();
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
        Schema::dropIfExists('customer_service_reports');
    }
}