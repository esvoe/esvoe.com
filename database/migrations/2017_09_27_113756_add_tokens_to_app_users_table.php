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
            $table->string('auth_token', 64)->nullable()->after('banned');
            $table->timestamp('auth_token_expire')->nullable()->after('auth_token');
            $table->string('session_token', 64)->nullable()->after('auth_token_expire');
            $table->timestamp('session_token_expire')->nullable()->after('session_token');
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
            $table->dropColumn('auth_token');
            $table->dropColumn('auth_token_expire');
            $table->dropColumn('session_token');
            $table->dropColumn('session_token_expire');

        });
    }
}
