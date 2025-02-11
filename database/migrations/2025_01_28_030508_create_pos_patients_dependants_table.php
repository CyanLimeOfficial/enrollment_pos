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
            $table->string('philhealth_id_2')->unique(); // Required
            $table->unsignedBigInteger('health_record_id_relation_2');
            $table->foreign('health_record_id_relation_2')->references('health_record_id')->on('pos_patients')->onDelete('cascade');
            $table->string('dependent_first_name')->nullable();
            $table->string('dependent_middle_name')->nullable();
            $table->string('dependent_last_name')->nullable();
            $table->string('dependent_extension_name')->nullable();
            $table->string('dependent_relationship')->nullable();
            $table->dateTime('dependent_date_of_birth')->nullable();
            $table->boolean('dependent_mononym')->nullable();
            $table->boolean('permanent_disability')->nullable();
            $table->text('attachment_type_2')->nullable(); // Optional
            $table->binary('attachment_2')->nullable(); // Optional
            $table->dateTime('admission_date_2')->nullable();; // Required
            $table->dateTime('discharge_date_2')->nullable(); // Optional
            $table->text('status_2')->nullable(); // Required
            $table->text('reason_or_purpose2')->nullable(); // Optional

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_patients_dependants');
    }
}