<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_reports', function (Blueprint $table) {
            $table->id();
            $table->text('createdBy');
            $table->text('contact_number');
            $table->text('cname');
            $table->text('location_district');
            $table->text('location_upazila');
            $table->text('address');
            $table->text('contact_person');
            $table->text('email');
            $table->text('visit_phone');
            $table->text('ctype');
            $table->text('isp_type');
            $table->text('visiting_card');
            $table->text('bandwidth');
            $table->text('rate');
            $table->text('otc');
            $table->text('remark');
            $table->text('audio');
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
        Schema::dropIfExists('customer_reports');
    }
}