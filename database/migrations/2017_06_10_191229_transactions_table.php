<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('external_transaction', 25);
            $table->integer('client_from')->unsigned();
            $table->integer('client_to')->unsigned();
            $table->integer('amount')->default(0);
            $table->enum('action', ['sell', 'buy','withdraw', 'mailing', 'standart']);
            $table->boolean('is_success');
            $table->boolean('is_deffered');            
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('client_from')->references('id')->on('timelines')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('client_to')->references('id')->on('timelines')
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_client_from_foreign');
            $table->dropForeign('transactions_client_to_foreign');
        });
        Schema::drop('transactions');
    }
}
