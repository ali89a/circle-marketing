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
            $table->string('contact_number')->unique();
            $table->string('cname');
            $table->text('location_district');
            $table->text('location_upazila');
            $table->text('address');
            $table->string('contact_person');
            $table->text('email')->unique();
            // $table->text('visit_phone');
            $table->enum('status', ['new', 'approved', 'canceled']);
           
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