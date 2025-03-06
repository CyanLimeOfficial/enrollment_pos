<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecordedByUserDetailsToPosPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_patients', function (Blueprint $table) {
            // Add the user ID column (for the relationship)
            $table->unsignedBigInteger('recorded_by_user_id')->nullable()->after('health_record_id');

            // Add the full name column (for quick reference)
            $table->string('recorded_by_user_full_name')->nullable()->after('recorded_by_user_id');

            // Add foreign key constraint for the user ID
            $table->foreign('recorded_by_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_patients', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['recorded_by_user_id']);

            // Drop the columns
            $table->dropColumn(['recorded_by_user_id', 'recorded_by_user_full_name']);
        });
    }
}
