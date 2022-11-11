<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('race')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('nric')->nullable();
            $table->string('gender')->nullable();
            $table->string('user_type');
            $table->date('date_of_birth')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->json('address')->nullable();
            //For Patient
            $table->boolean('subscribe_article')->default(0);
            //For Doctor
            $table->string('academic_title')->nullable();
            $table->json('qualifications')->nullable();
            $table->text('summary')->nullable();
            $table->json('specialty')->nullable();
            $table->string('experience')->nullable();
            //For Nurse 
            $table->string('department')->nullable();
            // For Doctor, Nurse and Medical Admin
            $table->string('instituition_id')->nullable();
            //For Group Admin
            $table->string('organization_id')->nullable();

            $table->boolean('suspended')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
