<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeline_id')->unsigned();
            $table->text('address');
            $table->boolean('active')->default(1);
            $table->integer('category_id')->unsigned();
            $table->string('message_privacy', 15);
            $table->string('member_privacy', 15);
            $table->string('phone', 15);
            $table->string('timeline_post_privacy', 15);
            $table->string('website', 255);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('pages');
    }
}
