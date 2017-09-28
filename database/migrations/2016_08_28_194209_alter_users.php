<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AlterUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('verified')->after('verification_code')->default(0);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->boolean('verified')->after('website')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('verified');
        });
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('verified');
        });
    }
}
