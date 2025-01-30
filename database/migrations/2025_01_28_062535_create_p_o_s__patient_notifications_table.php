<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosPatientNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('pos_patient_notifications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('patient_id'); // Foreign key
            $table->string('subject'); // Subject of notification
            $table->text('message'); // Notification message
            $table->enum('status', ['unread', 'read'])->default('unread'); // Status
            $table->timestamps(); // Created and updated timestamps

            // Foreign key relationship
            $table->foreign('patient_id')->references('health_record_id')->on('pos_patients')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pos_patient_notifications');
    }
}
