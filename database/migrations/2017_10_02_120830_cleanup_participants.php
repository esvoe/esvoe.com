<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleanupParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('participants')->orderBy('id')->chunk(30, function ($participants)
        {
            foreach ($participants as $participant)
            {
                $user_id = $participant->user_id;
                $thread_id = $participant->thread_id;

                if ($user_id <= 0 || $thread_id <= 0) {
                    DB::table('participants')->delete($participant->id);
                    Log::info("remove participant:", array('id'=>$participant->id, "user_id"=>$participant->user_id, "thread_id"=>$participant->thread_id));
                    continue;
                }

                $user = DB::table('users')
                    ->where('id', $participant->user_id)
                    ->first(['id']);
                if ( ! $user ) {
                    DB::table('participants')->delete($participant->id);
                    Log::info("remove participant(no user):", array('id'=>$participant->id, "user_id"=>$participant->user_id, "thread_id"=>$participant->thread_id));
                    continue;
                }

                $thread = DB::table('threads')
                    ->where('id', $participant->thread_id)
                    ->first(['id']);

                if ( ! $thread ) {
                    DB::table('participants')->delete($participant->id);
                    Log::info("remove participant(no thread):", array('id'=>$participant->id, "user_id"=>$participant->user_id, "thread_id"=>$participant->thread_id));
                    continue;
                }
            }
        });

        Schema::table('participants', function (Blueprint $table) {
            //
            $table->foreign('thread_id')->references('id')->on('threads')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            //
            Schema::table('participants', function (Blueprint $table) {
                $table->dropForeign('participants_user_id_foreign');
                $table->dropForeign('participants_thread_id_foreign');
            });
        });
    }
}
