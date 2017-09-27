<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseUpdateOneDotFour extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('events', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->nullable();

            $table->foreign('group_id')->references('id')->on('groups')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->integer('shared_post_id')->unsigned()->nullable();

            $table->foreign('shared_post_id')->references('id')->on('posts')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });

        Schema::table('groups', function (Blueprint $table) {
            $table->string('event_privacy')->after('post_privacy');
        });

        Setting::create(['key' => 'group_event_privacy', 'value' => 'only_admins']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_group_id_foreign');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_shared_post_id_foreign');
        });
    }
}
