<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DatabaseUpdateOneDotTwo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('facebook_link', 250)->after('language')->nullable();
            $table->string('twitter_link')->after('facebook_link')->nullable();
            $table->string('dribbble_link')->after('twitter_link')->nullable();
            $table->string('instagram_link')->after('dribbble_link')->nullable();
            $table->string('youtube_link')->after('instagram_link')->nullable();
            $table->string('linkedin_link')->after('youtube_link')->nullable();
        });

        Setting::create(['key' => 'site_tagline', 'value' => 'Laravel social network script']);
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
