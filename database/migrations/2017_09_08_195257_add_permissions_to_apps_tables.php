<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsToAppsTables extends Migration
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
            $table->text('permissions')->nullable()->after('description');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->text('permissions')->nullable()->after('user_id');
            $table->text('settings')->nullable()->after('permissions');
            $table->text('store')->nullable()->after('settings');
            $table->dropColumn('perm_install');
            $table->dropColumn('perm_profile');
            $table->dropColumn('perm_friends');
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
            $table->dropColumn('permissions');
            $table->dropColumn('settings');
            $table->dropColumn('store');
            //
            $table->boolean('perm_install')->default(false)->after('user_id');
            $table->boolean('perm_profile')->default(false)->after('perm_install');
            $table->boolean('perm_friends')->default(false)->after('perm_profile');
        });

        Schema::table('apps', function (Blueprint $table) {
            //
            $table->dropColumn('permissions');
        });
    }
}
