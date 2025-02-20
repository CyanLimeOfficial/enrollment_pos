<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_patients', function (Blueprint $table) {
            $table->id('health_record_id'); // Primary key, auto-increment
            $table->string('philhealth_id')->unique(); // Required
            $table->enum('purpose', ['Registration', 'Updating/Amendment']); // Required
            $table->string('provider_konsulta')->nullable(); // Optional

            // Member information
            $table->string('member_first_name'); // Required
            $table->string('member_middle_name')->nullable(); // Optional
            $table->string('member_last_name'); // Required
            $table->string('member_extension_name')->nullable(); // Optional
            $table->boolean('member_mononym')->default(false)->nullable(); // Optional

            // Mother's information
            $table->string('mother_first_name')->nullable(); // Optional
            $table->string('mother_middle_name')->nullable(); // Optional
            $table->string('mother_last_name')->nullable(); // Optional
            $table->string('mother_extension_name')->nullable(); // Optional
            $table->boolean('mother_mononym')->default(false)->nullable(); // Optional

            // Spouse's information
            $table->string('spouse_first_name')->nullable(); // Optional
            $table->string('spouse_middle_name')->nullable(); // Optional
            $table->string('spouse_last_name')->nullable(); // Optional
            $table->string('spouse_extension_name')->nullable(); // Optional
            $table->boolean('spouse_mononym')->default(false)->nullable(); // Optional

            // Other personal details
            $table->dateTime('date_of_birth'); // Required
            $table->text('place_of_birth'); // Required
            $table->enum('sex', ['Male', 'Female']); // Required
            $table->enum('civil_status', ['Single', 'Married', 'Annulled', 'Widower', 'Legally Separated']); // Required
            $table->enum('citizenship', ['Filipino', 'Foreign National', 'Dual Citizen']); // Required
            $table->bigInteger('philsys_id')->nullable(); // Optional
            $table->bigInteger('tax_payer_id')->nullable(); // Optional

            // Contact information
            $table->text('address'); // Required
            $table->bigInteger('contact_number')->nullable();; // Optional
            $table->string('home_phone_number')->nullable(); // Optional
            $table->bigInteger('business_direct_line')->nullable(); // Optional
            $table->string('email_address')->nullable(); // Optional
            $table->string('mailing_address')->nullable(); // Optional

            // Admission details
            $table->dateTime('admission_date')->nullable(); // Required
            $table->dateTime('discharge_date')->nullable(); // Optional

            // Newly added fields
            $table->text('reason_or_purpose')->nullable(); // Optional
            $table->text('status')->nullable(); // Required
            $table->text('attachment_type_1')->nullable(); // Required
            $table->binary('attachment_1')->nullable(); // Required
            $table->boolean('archive_lock_1')->nullable();
            $table->string('transmittal_id_1')->nullable();

            // Timestamps
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
        Schema::dropIfExists('pos_patients');
    }
}
