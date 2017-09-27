<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('comment_privacy', 15);
            $table->string('follow_privacy', 15);
            $table->string('post_privacy', 15);
            $table->string('confirm_follow', 15);
            $table->string('timeline_post_privacy', 15);
            $table->string('email_follow', 15)->default('no');
            $table->string('email_like_post', 15)->default('no');
            $table->string('email_post_share', 15)->default('no');
            $table->string('email_comment_post', 15)->default('no');
            $table->string('email_like_comment', 15)->default('no');
            $table->string('email_reply_comment', 15)->default('no');
            $table->string('email_join_group', 15)->default('no');
            $table->string('email_like_page', 15)->default('no');
        });
    }

    public function down()
    {
        Schema::drop('user_settings');
    }
}
