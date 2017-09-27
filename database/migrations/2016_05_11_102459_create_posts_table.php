<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->integer('timeline_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('active')->default(1);
            $table->string('soundcloud_title', 250);
            $table->string('soundcloud_id', 255);
            $table->string('youtube_title', 255);
            $table->string('youtube_video_id', 250);
            $table->string('location', 250);
            $table->string('type', 100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('posts');
    }
}
