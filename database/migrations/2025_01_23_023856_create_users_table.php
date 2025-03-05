<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('username')->unique(); // Unique username
            $table->string('password'); // Hashed password
            $table->string('email')->unique(); // Unique email address
            $table->string('number'); // Phone number
            $table->string('first_name'); // First name
            $table->string('middle_name')->nullable(); // Middle name (optional)
            $table->string('last_name'); // Last name
            $table->string('suffix')->nullable(); // Suffix (optional)
            $table->boolean('is_active')->default(0); // Suffix (optional)
            $table->timestamps(); // Created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

