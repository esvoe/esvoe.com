<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeline_id')->unsigned();
            $table->string('email', 250);
            $table->string('verification_code', 250);
            $table->boolean('email_verified');
            $table->string('remember_token', 250);
            $table->string('password', 250);
            $table->float('balance')->default(0);
            $table->date('birthday');
            $table->string('city', 100);
            $table->string('country', 100);
            $table->string('gender');
            $table->boolean('active')->default(1);
            $table->timestamp('last_logged')->nullable();
            $table->string('timezone');
            $table->integer('affiliate_id')->unsigned()->nullable();
            $table->string('language', 15)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
