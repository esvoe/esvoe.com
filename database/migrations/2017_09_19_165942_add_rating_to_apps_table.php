<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRatingToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            //
            $table->integer('rate_value')->default(0)->after('rate');
            $table->integer('rate_count')->default(0)->after('rate_value');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->boolean('enabled')->default(true)->after('user_id');
            $table->integer('rate_value')->default(0)->after('store');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            //
            $table->dropColumn('rate_value');
            $table->dropColumn('rate_count');
        });

        Schema::table('app_users', function (Blueprint $table) {
            //
            $table->dropColumn('enabled');
            $table->dropColumn('rate_value');
        });
    }
}
