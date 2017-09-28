<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHiddenCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('hidden_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('reason', 64);
            $table->timestamps();
        });

        Schema::table('hidden_comments', function (Blueprint $table) {
            $table->foreign('comment_id')->references('id')->on('comments')
                ->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('hidden_comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::table('hidden_comments', function (Blueprint $table) {
            $table->dropForeign('hidden_comments_comment_id_foreign');
        });
        Schema::table('hidden_comments', function (Blueprint $table) {
            $table->dropForeign('hidden_comments_user_id_foreign');
        });

        Schema::drop('hidden_comments');
    }
}
