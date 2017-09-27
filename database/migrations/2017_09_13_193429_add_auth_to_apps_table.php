<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            //
            $table->boolean('auth_dispatch_changes')->default(false)->after('api_url');
            $table->string('auth_redirect_hosts_filter', 1024)->nullable()->after('auth_dispatch_changes');
            $table->string('settings')->nullable()->after('permissions');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->boolean('authorized')->default(false)->after('user_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            //
            $table->dropColumn('auth_dispatch_changes');
            $table->dropColumn('auth_redirect_hosts_filter');
            $table->dropColumn('settings');
        });
        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->dropColumn('authorized');
        });
    }
}
