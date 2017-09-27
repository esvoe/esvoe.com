<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTimelinesTable extends Migration
{
    public function up()
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 250)->unique();
            $table->string('name', 250);
            $table->text('about');
            $table->integer('avatar_id')->unsigned()->nullable();
            $table->integer('cover_id')->unsigned()->nullable();
            $table->string('cover_position', 255);
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('timelines');
    }
}
