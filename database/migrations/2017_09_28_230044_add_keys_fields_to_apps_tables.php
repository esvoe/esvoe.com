<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKeysFieldsToAppsTables extends Migration
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
            if ( ! Schema::hasColumn('apps', 'api_public_key'))
                $table->string('api_public_key', 64)->nullable()->after('pay_sign');
            if ( ! Schema::hasColumn('apps', 'api_private_key'))
                $table->string('api_private_key', 64)->nullable()->after('api_public_key');
            if ( ! Schema::hasColumn('apps', 'api_signing_key'))
                $table->string('api_signing_key', 64)->nullable()->after('api_private_key');

            if (Schema::hasColumn('apps', 'auth_dispatch_changes'))
                $table->dropColumn('auth_dispatch_changes');
            if (Schema::hasColumn('apps', 'auth_redirect_hosts_filter'))
                $table->dropColumn('auth_redirect_hosts_filter');
            if (Schema::hasColumn('apps', 'permissions'))
                $table->dropColumn('permissions');
            if (Schema::hasColumn('apps', 'settings'))
                $table->dropColumn('settings');

        });

        Schema::table('apps', function (Blueprint $table) {
            //
            if ( ! Schema::hasColumn('apps', 'permissions'))
                $table->text('permissions')->nullable()->after('description');
            if ( ! Schema::hasColumn('apps', 'settings'))
                $table->text('settings')->nullable()->after('permissions');

        });

        if ( ! Schema::hasTable('app_settings')) {
            Schema::create('app_settings', function (Blueprint $table) {
                $table->integer('id', false, true);
                $table->primary('id');
                $table->foreign('id')->references('id')->on('apps')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }
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
            if (Schema::hasColumn('apps', 'api_public_key'))
                $table->dropColumn('api_public_key');
            if (Schema::hasColumn('apps', 'api_private_key'))
                $table->dropColumn('api_private_key');
            if (Schema::hasColumn('apps', 'api_signing_key'))
                $table->dropColumn('api_signing_key');
        });

        if (Schema::hasTable('app_settings')) {
            Schema::table('app_settings', function (Blueprint $table) {
                $table->dropForeign('app_settings_id_foreign');
            });
            Schema::drop('app_settings');
        }
    }
}
