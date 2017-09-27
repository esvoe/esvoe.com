<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToThreads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->enum('type', ['dialog', 'group'])->after('id');
        });
        \DB::table('threads')->where('subject', '<>', '')->update(['type' => 'group']);
        \DB::table('threads')->where('type', '<>', 'group')->update(['type' => 'dialog']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('threads', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
