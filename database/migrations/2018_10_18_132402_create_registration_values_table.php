<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_registration_id')->unsigned();
            $table->integer('field_id')->unsigned();
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('registration_values', function (Blueprint $table) {
            $table->foreign('event_registration_id')->references('id')->on('event_registrations');
            $table->foreign('field_id')->references('id')->on('fields');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registration_values');
    }
}
