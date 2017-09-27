<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('bilance');
            $table->dropColumn('perspective');
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->integer('token')->default(0)->after('timeline_id');
            $table->integer('euro')->default(0)->after('token');
            $table->integer('dollar')->default(0)->after('euro');
            $table->integer('grivna')->default(0)->after('dollar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('euro');
            $table->dropColumn('dollar');
            $table->dropColumn('grivna');
        });

        Schema::table('wallets', function (Blueprint $table) {
            $table->integer('bilance')->default(0)->after('timeline_id');
            $table->integer('perspective')->default(0)->after('bilance'); 
        });
    }
}
