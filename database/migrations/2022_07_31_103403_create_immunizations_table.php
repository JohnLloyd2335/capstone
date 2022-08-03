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
        Schema::create('immunizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('immunization_category_id');
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
            $table->timestamps();
            $table->foreign('immunization_category_id')->references('id')->on('immunization_categories')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immunizations');
    }
};
