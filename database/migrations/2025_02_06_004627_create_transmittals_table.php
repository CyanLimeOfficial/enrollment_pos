<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transmittals', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('transmittal_id')->unique()->nullable(); // Unique Transmittal ID
            $table->binary('attachment_transmittal')->nullable(); // Optional
            $table->date('date_prepared')->nullable(); // Date of preparation
            $table->string('prepared_by')->nullable(); // User who prepared
            $table->integer('number_of_claims')->nullable(); // Number of claims
            $table->unsignedBigInteger('issued_by'); // User who issued the document
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transmittals');
    }
};
