<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FollowerIsBlock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->tinyInteger('is_block')->unsigned()->default(0)->after('relative_id');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->integer('count_relative')->unsigned()->default(0)->after('count_invite');
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
