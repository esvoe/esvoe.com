<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DatabaseUpdateThree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('timelines', function($table) {
            $table->integer('hide_cover')->after('type')->default(0);
            $table->integer('background_id')->after('hide_cover')->unsigned()->nullable();
        });

        Schema::table('timelines', function (Blueprint $table) {
            $table->foreign('background_id')->references('id')->on('media')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });

        Schema::table('pages', function($table) {
            $table->string('member_privacy', 15)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropForeign('timelines_background_id_foreign');
        });
    }
}
