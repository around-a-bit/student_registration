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


        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('fname', 255)->nullable();
            $table->string('lname', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->string('mobile', 255)->nullable();
            $table->string('signature')->nullable();
            $table->string('password', 255);
            $table->string('photo')->nullable();
            $table->string('registration_no', 255)->unique();
            $table->string('token',1000)->nullable()->change();
            $table->string('otp', 4)->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamps();
             // $table->unsignedBigInteger('gender_id');
            // $table->string('uid', 255)->nullable();
            // $table->unsignedBigInteger('degree_id');
            // $table->unsignedBigInteger('specialization_id');
            // $table->unsignedBigInteger('school_id');
            // $table->string('dob', 255)->nullable();
            // $table->unsignedBigInteger('country_id');
            // $table->unsignedBigInteger('state_id');
            // $table->unsignedBigInteger('district_id');
            // $table->string('pin', 255)->nullable();


            // Define foreign keys within the Schema::create() block
            // $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');
            // $table->foreign('degree_id')->references('id')->on('degrees')->onDelete('cascade');
            // $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
            // $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
            // $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            // $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            // $table->engine = 'InnoDB';
        });
    }




    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
    
};
