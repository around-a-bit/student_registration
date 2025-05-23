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
        Schema::create('student_education_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('degree_id');
            $table->unsignedBigInteger('specialization_id');
            $table->unsignedBigInteger('school_id');
            $table->string('uid', 255)->nullable();
            $table->timestamps();
            
            // Define foreign keys within the Schema::create() block
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_education_details');
    }
};
