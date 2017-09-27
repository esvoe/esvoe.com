<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTokensToAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->string('auth_token', 64)->after('banned');
            $table->timestamp('auth_token_expire')->after('auth_token');
            $table->string('session_token', 64)->after('auth_token_expire');
            $table->timestamp('session_token_expire')->after('session_token');
            $table->string('session_secret', 64)->after('session_token_expire');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_users', function (Blueprint $table) {
            //
        });
    }
}
