<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppsRelatedTables extends Migration
{


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Just to make sure it clean apps install

        Schema::dropIfExists('app_action_logs');
        Schema::dropIfExists('app_users');
        Schema::dropIfExists('apps');
        Schema::dropIfExists('app_categories');

        // Create tables and stuff

        Schema::create('app_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name', 255); // unique category name
            $table->string('title', 255)->nullable();
            $table->string('description', 1024)->nullable();
            $table->string('image_small', 255)->nullable();
            $table->string('image_large', 255)->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_visible')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('app_categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('app_categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });

        Schema::create('apps', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('name', 255); // Unique application name
            $table->integer('type')->default(0); // Application type
            $table->integer('state')->default(0); // Internal application state.
            $table->boolean('is_active')->default(false); // Mark application usable for users
            $table->boolean('is_visible')->default(false); // Mark application is visible for users

            $table->integer('pay_id')->nullable();
            $table->string('pay_sign', 255)->nullable();

            $table->string('api_key', 255)->nullable(); // used for packet signing
            $table->string('api_url', 1024)->nullable(); // Ex

            $table->string('url_main', 1024)->nullable(); // Used as main external url of application

            $table->string('title', 255)->nullable();
            $table->string('description', 1024)->nullable();

            $table->string('image_icon', 255)->nullable();
            $table->string('image_main', 255)->nullable();
            $table->string('image_promo', 255)->nullable();

            $table->integer('rate')->default(0); // 1 to 5 values
            $table->integer('count_users')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });


        Schema::table('apps', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('app_categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unique('name');
        });

        Schema::create('app_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('perm_install')->default(false);
            $table->boolean('perm_profile')->default(false);
            $table->boolean('perm_friends')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('app_users', function (Blueprint $table) {
            $table->foreign('app_id')->references('id')->on('apps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unique(['app_id', 'user_id']);
        });

        Schema::create('app_action_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->integer('action_id')->unsigned()->nullable();
            $table->integer('action_type')->default('0');
            $table->integer('action_user_id')->unsigned()->nullable();
            $table->text('action_payload')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('app_action_logs', function (Blueprint $table) {
            $table->foreign('app_id')->references('id')->on('apps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('action_user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('app_action_logs', function (Blueprint $table) {
            $table->dropForeign('app_action_logs_app_id_foreign');
            $table->dropForeign('app_action_logs_action_user_id_foreign');
        });
        Schema::dropIfExists('app_action_logs');

        Schema::table('app_users', function (Blueprint $table) {
            $table->dropForeign('app_users_app_id_foreign');
            $table->dropForeign('app_users_user_id_foreign');
            $table->dropUnique('app_users_app_id_user_id_unique');
        });
        Schema::dropIfExists('app_users');

        Schema::table('apps', function (Blueprint $table) {
            $table->dropForeign('apps_user_id_foreign');
            $table->dropForeign('apps_category_id_foreign');
        });

        Schema::dropIfExists('apps');

        Schema::table('app_categories', function (Blueprint $table) {
            $table->dropForeign('app_categories_parent_id_foreign');
        });

        Schema::dropIfExists('app_categories');

    }
}
