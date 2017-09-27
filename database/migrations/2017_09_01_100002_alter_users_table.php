<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('wallet_id')->unsigned()->nullable()->after('timeline_id');
            $table->string('esvoe_id', 250)->nullable()->after('id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('wallet_id')->references('id')->on('wallets')
                ->onDelete('cascade')->onUpdate('cascade');
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
            $table->dropForeign('users_wallet_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wallet_id');
            $table->dropColumn('esvoe_id');
        });
    }
}
