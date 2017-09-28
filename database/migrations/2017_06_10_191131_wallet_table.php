<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WalletTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeline_id')->unsigned();
            $table->integer('bilance')->default(0);
            $table->integer('perspective')->default(0);            
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('wallets', function (Blueprint $table) {
            $table->foreign('timeline_id')->references('id')->on('timelines')
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
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropForeign('wallets_timeline_id_foreign');
        });
        Schema::drop('wallets');
    }
}
