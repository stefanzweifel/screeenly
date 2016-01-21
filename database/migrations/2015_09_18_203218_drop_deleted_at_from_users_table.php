<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropDeletedAtFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('api_keys', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('api_log', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('api_keys', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('api_log', function (Blueprint $table) {
            $table->softDeletes();
        });

    }
}
