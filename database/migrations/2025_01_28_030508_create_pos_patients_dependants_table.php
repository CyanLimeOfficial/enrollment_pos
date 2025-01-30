<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosPatientsDependantsTable extends Migration
{
    public function up()
    {
        Schema::create('pos_patients_dependants', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id('dependent_hospital_id');
            $table->unsignedBigInteger('health_record_id_relation_2'); // Ensure this matches the type of the referenced column
            $table->foreign('health_record_id_relation_2')->references('health_record_id')->on('pos_patients')->onDelete('cascade');
            $table->string('dependent_first_name');
            $table->string('dependent_middle_name')->nullable();
            $table->string('dependent_last_name');
            $table->string('dependent_extension_name')->nullable();
            $table->string('dependent_relationship');
            $table->dateTime('dependent_date_of_birth');
            $table->boolean('dependent_mononym')->nullable();
            $table->boolean('permanent_disability')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_patients_dependants');
    }
}