<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeFollower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->unsignedTinyInteger('is_follower')->default(0)->after('leader_id')->comment("0-not, 1-yes");
	        $table->dropColumn('is_friend');
	        $table->dropColumn('status');
        });

        Schema::table('followers', function (Blueprint $table) {
            $table->unsignedTinyInteger('type_friend')->default(0)->after('is_follower')->comment("0 - no friend, 1 - invite, 2 - friend");
            $table->unsignedTinyInteger('relative_id')->after('type_friend')->nullable()->comment("dad,mam,son,daughter,brother,sister,husband,wife,nephew,niece,uncle,aunt,...");
            $table->string('statuses', 512)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('followers', function (Blueprint $table) {
            $table->dropColumn('is_follower');
            $table->dropColumn('type_friend');
            $table->dropColumn('relative_id');
            $table->dropColumn('statuses');
            $table->unsignedTinyInteger('is_friend')->default(0)->after('leader_id');
            $table->string('status', 50);
        });
    }
}