<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string("owner_id");
            $table->string("patient_id")->nullable();
            $table->string("owner_type");
            $table->string("prescription_id")->nullable();
            $table->json("time_slot");
            $table->string("satisfaction_id")->nullable();
            $table->string("instituition_id");
            $table->string("appointment_type");
            $table->string("symptoms")->nullable();
            $table->boolean("status")->default(0);
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
        Schema::dropIfExists('appointments');
    }
}
