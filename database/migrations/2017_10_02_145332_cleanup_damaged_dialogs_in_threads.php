<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupDamagedDialogsInThreads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('threads')->where('type', 'dialog')->orderBy('id')->chunk(1000, function ($threads) {
            $affected = 0;
            foreach ($threads as $thread) {
                $count = DB::table('participants')->where('thread_id', $thread->id)->count('id');

                if ($count < 2) {
                    Log::info("delete thread id: ", array('id' => $thread->id));
                    DB::table('threads')->delete($thread->id);
                    $affected++;
                }
            }

            Log::info("dead threads>>>", array("found"=>$affected, "total"=>1000));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
