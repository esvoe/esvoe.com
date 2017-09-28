<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHiddenPostsTable extends Migration
{
    public function up()
    {
        Schema::create('hidden_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('reason', 64);
            $table->timestamps();
        });

        Schema::table('hidden_posts', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('hidden_posts', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('hidden_posts', function (Blueprint $table) {
            $table->dropForeign('hidden_posts_post_id_foreign');
        });
        Schema::table('hidden_posts', function (Blueprint $table) {
            $table->dropForeign('hidden_posts_user_id_foreign');
        });

        Schema::drop('hidden_posts');
    }
}
