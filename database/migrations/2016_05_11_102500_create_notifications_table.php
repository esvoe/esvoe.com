<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned()->nullable();
            $table->integer('timeline_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('notified_by')->unsigned();
            $table->boolean('seen')->default(0);
            $table->text('description');
            $table->string('type', 250);
            $table->string('link', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('notifications');
    }
}
