<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseUpdateOneDotThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_settings', function (Blueprint $table) {
            $table->string('message_privacy')->after('timeline_post_privacy')->default(0);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('designation')->after('country')->nullable();
            $table->string('hobbies')->after('designation')->nullable();
            $table->string('interests')->after('hobbies')->nullable();
            $table->string('custom_option1')->after('interests')->nullable();
            $table->string('custom_option2')->after('custom_option1')->nullable();
            $table->string('custom_option3')->after('custom_option2')->nullable();
            $table->string('custom_option4')->after('custom_option3')->nullable();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeline_id')->unsigned();
            $table->string('type');
            $table->string('location');
            $table->integer('user_id')->unsigned();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('active')->default(1);
            $table->string('invite_privacy');
            $table->string('timeline_post_privacy');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('event_user', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('events')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('event_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Setting::create(['key' => 'invite_privacy', 'value' => 'only_admins']);
        Setting::create(['key' => 'event_timeline_post_privacy', 'value' => 'only_guests']);

        Setting::create(['key' => 'title_seperator', 'value' => '|']);
        Setting::create(['key' => 'timezone', 'value' => 'Europe/Kiev']);
        Setting::create(['key' => 'enable_rtl', 'value' => 'off']);
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_timeline_id_foreign');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_user_id_foreign');
        });


        Schema::table('event_user', function (Blueprint $table) {
            $table->dropForeign('event_user_event_id_foreign');
        });

        Schema::table('event_user', function (Blueprint $table) {
            $table->dropForeign('event_user_user_id_foreign');
        });

        Schema::drop('events');


        Schema::drop('event_user');
    }
}
