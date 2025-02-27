<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosPatientMemberUpdateAmendmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
        Schema::create('pos_patient_member_update_amendment', function (Blueprint $table) {
            // Use health_record_id as the primary key to enforce one-to-one relation.
            $table->unsignedBigInteger('health_record_id')->primary();

            // DIRECT CONTRIBUTOR Options
            $table->boolean('employed_private')->nullable()->default(false);
            $table->boolean('employed_government')->nullable()->default(false);
            $table->boolean('professional_practitioner')->nullable()->default(false);

            // Under Self-Earning Individual
            $table->boolean('individual')->nullable()->default(false);
            $table->boolean('sole_proprietor')->nullable()->default(false);
            $table->text('group_enrollment_scheme')->nullable();
            $table->boolean('kasambahay')->nullable()->default(false);
            // Under Migrant Worker
            $table->boolean('migrant_worker_land_based')->nullable()->default(false);
            $table->boolean('migrant_worker_sea_based')->nullable()->default(false);
            $table->boolean('lifetime_member')->nullable()->default(false);
            $table->boolean('filipinos_with_dual_citizenship_living_abroad')->nullable()->default(false);
            $table->boolean('foreign_national')->nullable()->default(false);
            $table->text('pra_srrv_no')->nullable();
            $table->text('acr_i_card_no')->nullable();
            $table->boolean('family_driver')->nullable()->default(false);

            // Additional DIRECT CONTRIBUTOR fields
            $table->text('profession')->nullable();
            $table->text('monthly_income')->nullable();
            $table->text('proof_of_income')->nullable();

            // INDIRECT CONTRIBUTOR Options
            $table->boolean('listahanan')->nullable()->default(false);
            $table->boolean('four_ps_mcct')->nullable()->default(false);
            $table->boolean('senior_citizen')->nullable()->default(false);
            $table->boolean('pamana')->nullable()->default(false);
            $table->boolean('kia_kipo')->nullable()->default(false);
            $table->boolean('lgu_sponsored')->nullable()->default(false);
            $table->boolean('nga_sponsored_private_sponsored')->nullable()->default(false);
            $table->boolean('person_with_disability')->nullable()->default(false);
            $table->text('pwd_id_no')->nullable();
            $table->boolean('bangsamoro_normalization')->nullable()->default(false);

            // For PhilHealth Use Only
            $table->boolean('pos_financially_incapable')->nullable()->default(false);
            $table->boolean('financially_incapable')->nullable()->default(false);

            // Updating fields (all text)
            $table->text('from_correction_name')->nullable();
            $table->text('from_correction_birth')->nullable();
            $table->text('from_correction_sex')->nullable();
            $table->text('from_correction_civil_status')->nullable();
            $table->text('from_update_general')->nullable();
            $table->text('to_correction_name')->nullable();
            $table->text('to_correction_birth')->nullable();
            $table->text('to_correction_sex')->nullable();
            $table->text('to_correction_civil_status')->nullable();
            $table->text('to_update_general')->nullable();

            // Optional timestamps
            $table->timestamps();

            // Foreign key constraint: health_record_id references pos_patients(health_record_id)
            $table->foreign('health_record_id')
                  ->references('health_record_id')
                  ->on('pos_patients')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pos_patient_member_update_amendment');
    }
}
