<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyProfilePictureColumnInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Use raw SQL to modify the column type to LONGBLOB
        DB::statement('ALTER TABLE users MODIFY profile_picture LONGBLOB');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert back to mediumBlob if needed
        DB::statement('ALTER TABLE users MODIFY profile_picture MEDIUMBLOB');
    }
}
