<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('firstname', 32)->default('');
            $table->string('lastname', 32)->nullable();
            $table->string('avatar', 512)->nullable();
            $table->date('birthday')->nullable();
            $table->unsignedTinyInteger('gender')->default(1)->comment('1-male, 2-female');
            $table->unsignedInteger('count_following')->default(0);
            $table->unsignedInteger('count_follower')->default(0);
            $table->unsignedInteger('count_friend')->default(0);
            $table->unsignedInteger('count_invite')->default(0);
            $table->string('city', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('designation', 250)->nullable();
            $table->string('hobbies', 250)->nullable();
            $table->string('interests', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique('user_id', 'user_id');

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_profiles');
    }
}
