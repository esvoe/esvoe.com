<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseUpdateTwoDotTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $platform = Schema::getConnection()->getDoctrineSchemaManager()->getDatabasePlatform();
        $platform->registerDoctrineTypeMapping('enum', 'string');
        
        Schema::table('pages', function (Blueprint $table) {
            $table->text('address')->nullable()->change();
            $table->string('phone', 15)->nullable()->change();
            $table->string('website', 255)->nullable()->change();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('soundcloud_title', 250)->nullable()->change();
            $table->string('soundcloud_id', 255)->nullable()->change();
            $table->string('youtube_title', 255)->nullable()->change();
            $table->string('youtube_video_id', 250)->nullable()->change();
            $table->string('location', 250)->nullable()->change();
            $table->string('type', 100)->nullable()->change();
        });

        Schema::table('timelines', function (Blueprint $table) {
            $table->string('cover_position', 255)->nullable()->change();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('email_verified')->nullable()->change();
            $table->date('birthday')->default('1970-01-01')->change();
            $table->string('city', 100)->nullable()->change();
            $table->string('country', 100)->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->string('timezone')->nullable()->change();
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->string('image', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
