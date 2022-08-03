<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('immunization_id');
            $table->unsignedBigInteger('immunization_category_id');
            $table->foreign('immunization_category_id')->references('id')->on('immunization_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('age');
            $table->date('date_of_birth');
            $table->string('place_of_birth');
            $table->string('address');
            $table->string('contact_no');
            $table->string('mother_full_name');
            $table->string('father_full_name');
            $table->string('weight');
            $table->string('height');
            $table->string('sex');
            $table->string('vaccine_received');
            $table->integer('doses');
            $table->integer('doses_received');
            $table->string('first_dose_schedule');
            $table->string('second_dose_schedule');
            $table->string('third_dose_schedule');
            $table->string('remarks');
            date_default_timezone_set('Asia/Manila');
            
            $table->date('date_recorded');
            $table->date('date_updated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archives');
    }
};
