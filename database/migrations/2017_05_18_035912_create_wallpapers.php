<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWallpapers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallpapers', function (Blueprint $table) {
            $table->increments('id'); // was $table->primary('id')->increments('id');
            $table->string('title', 255);
            $table->integer('media_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('wallpapers', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallpapers', function (Blueprint $table) {
            $table->dropForeign('wallpapers_media_id_foreign');
        });
        Schema::drop('wallpapers');
    }
}
