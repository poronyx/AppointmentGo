<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstituitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instituition', function (Blueprint $table) {
            $table->id();
            $table->string("instituition_type");
            $table->string("instituition_name");
            $table->string("instituition_addr");
            $table->string("instituition_phone");
            $table->string("instituition_desc");
            $table->string("lat");
            $table->string("lon");
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
        Schema::dropIfExists('instituition');
    }
}
