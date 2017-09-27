<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppsRelatedTables extends Migration
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
            $table->string('name', 255)->nullable()->change();
        });

        Schema::table('app_categories', function (Blueprint $table) {
            //
            $table->string('name', 255)->nullable()->change();
            $table->integer('type')->default(0)->after('parent_id');
            $table->integer('level')->default(0)->after('is_visible');
            $table->integer('order')->default(0)->after('level');
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
            $table->string('name', 255)->nullable(false)->change();
        });
        Schema::table('app_categories', function (Blueprint $table) {
            //
            $table->string('name', 255)->nullable(false)->change();
            $table->dropColumn('type');
            $table->dropColumn('level');
            $table->dropColumn('order');
        });
    }
}
