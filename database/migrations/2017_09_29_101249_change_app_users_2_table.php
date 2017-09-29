<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeAppUsers2Table extends Migration
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
            if (Schema::hasColumn('app_users', 'auth_token')) {
                $table->renameColumn('auth_token', 'api_access_token');
            }
            if (Schema::hasColumn('app_users', 'auth_token_expire')) {
                $table->renameColumn('auth_token_expire', 'api_access_token_expire');
            }
            if (Schema::hasColumn('app_users', 'session_token')) {
                $table->renameColumn('session_token', 'api_session_key');
            }
            if (Schema::hasColumn('app_users', 'session_token_expire')) {
                $table->renameColumn('session_token_expire', 'api_session_key_expire');
            }
        });

        Schema::table('app_users', function (Blueprint $table) {
            if (!Schema::hasColumn('app_users', 'api_session_secret')) {
                $table->string('api_session_secret', 64)->nullable()->after('api_session_key_expire');
            }
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
            if (Schema::hasColumn('app_users', 'api_access_token')) {
                $table->renameColumn('api_access_token', 'auth_token');
            }
            if (Schema::hasColumn('app_users', 'api_access_token_expire')) {
                $table->renameColumn('api_access_token_expire','auth_token_expire');
            }
            if (Schema::hasColumn('app_users', 'api_session_key')) {
                $table->renameColumn('api_session_key', 'session_token');
            }
            if (Schema::hasColumn('app_users', 'api_session_key_expire')) {
                $table->renameColumn('api_session_key_expire','session_token_expire');
            }
            if ( Schema::hasColumn('app_users', 'api_session_secret')) {
                $table->removeColumn('api_session_secret');
            }
        });
    }
}
