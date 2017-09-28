<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRatingOnAppsTable extends Migration
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
            $table->dropColumn('rate_count');
            $table->dropColumn('rate_value');
            $table->dropColumn('rate');
            $table->string('rating', 255)->nullable()->after('image_promo');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->renameColumn('rate_value', 'rating');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->boolean('banned')->default(false)->after('rating');
        });

        Schema::create('app_images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('order')->default(0);
            $table->string('path',255)->nullable();
        });

        Schema::table('app_images', function (Blueprint $table) {
            $table->foreign('app_id')->references('id')->on('apps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('app_endpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->string('name', 128)->nullable();
            $table->string('url', 128)->nullable();
            $table->string('domain', 128)->nullable();
            $table->string('redirect',255)->nullable();
        });

        Schema::table('app_endpoints', function (Blueprint $table) {
            $table->foreign('app_id')->references('id')->on('apps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::table('app_action_logs', function (Blueprint $table) {
            $table->dropForeign('app_action_logs_app_id_foreign');
            $table->dropForeign('app_action_logs_action_user_id_foreign');
        });
        Schema::dropIfExists('app_action_logs');

        Schema::create('app_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('app_id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('type')->default('0');
            $table->text('payload')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('app_logs', function (Blueprint $table) {
            $table->foreign('app_id')->references('id')->on('apps')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::table('apps', function (Blueprint $table) {
            //
            $table->integer('rate')->default(0)->after('image_promo');
            $table->integer('rate_value')->default(0)->after('rate');
            $table->integer('rate_count')->default(0)->after('rate_value');
            $table->dropColumn('rating');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->renameColumn('rating', 'rate_value');
            $table->dropColumn('banned');
        });

        Schema::table('app_images', function (Blueprint $table) {
            $table->dropForeign('app_images_app_id_foreign');
        });

        Schema::dropIfExists('app_images');

        Schema::table('app_endpoints', function (Blueprint $table) {
            $table->dropForeign('app_endpoints_app_id_foreign');
        });

        Schema::dropIfExists('app_endpoints');


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


        Schema::table('app_logs', function (Blueprint $table) {
            $table->dropForeign('app_logs_app_id_foreign');
            $table->dropForeign('app_logs_user_id_foreign');
        });
        Schema::dropIfExists('app_logs');

    }
}
