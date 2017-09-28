<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveUserProfileDataToUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('gender');
        });

        Schema::table('user_profiles', function (Blueprint $table) {
            $table->enum('gender', ['male', 'female', 'other'])->after('birthday');
        });

        DB::table('users')->orderBy('id')->chunk(100, function ($users)
        {
            foreach ($users as $user)
            {
                $timeline = DB::table('timelines')
                    ->where('id', $user->timeline_id)
                    ->first(['name', 'sename', 'avatar_id']);

                if (empty($timeline->sename)) {
                    $nameArr = explode(' ', trim($timeline->name));
                    $firstname = array_shift($nameArr);
                    $lastname = empty($nameArr)
                        ? null
                        : implode(' ', $nameArr);
                } else {
                    $firstname = $timeline->name;
                    $lastname = $timeline->sename;
                }

                DB::table('user_profiles')->updateOrInsert(
                    ['user_id' => $user->id],
                    [
                        'firstname'     => $firstname,
                        'lastname'      => $lastname,
                        'avatar'        => empty($timeline->avatar_id)
                            ? null
                            : DB::table('media')->where('id', $timeline->avatar_id)->value('source'),
                        'birthday'      => $user->birthday,
                        'gender'        => $this->genderToProfile($user->gender),
                        'count_following'   => DB::table('followers')
                            ->where('follower_id', $user->id)
                            ->where('is_follower', 1)
                            ->count('id'),
                        'count_follower'    => DB::table('followers')
                            ->where('leader_id', $user->id)
                            ->where('is_follower', 1)
                            ->count('id'),
                        'count_friend'      => DB::table('followers')
                            ->where('type_friend', config('friend.type.approve'))
                            ->where(function ($query) use ($user) {
                                $query->where('leader_id', $user->id)
                                    ->orWhere('follower_id', $user->id);
                            })
                            ->count('id'),
                        'count_invite'      => DB::table('followers')
                            ->where('type_friend', config('friend.type.invite'))
                            ->where(function ($query) use ($user) {
                                $query->where('leader_id', $user->id)
                                    ->orWhere('follower_id', $user->id);
                            })
                            ->count('id'),
                        'city'          => $user->city,
                        'country'       => $user->country,
                        'designation'   => $user->designation,
                        'hobbies'       => $user->hobbies,
                        'interests'     => $user->interests,
                        'created_at'    => $user->created_at,
                        'updated_at'    => $user->updated_at,
                        'deleted_at'    => $user->deleted_at
                    ]
                );
            }
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('city');
            $table->dropColumn('country');
            $table->dropColumn('designation');
            $table->dropColumn('hobbies');
            $table->dropColumn('interests');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropColumn('sename');
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
            $table->date('birthday')->after('balance');
            $table->string('city', 100)->nullable()->after('birthday');
            $table->string('country', 100)->nullable()->after('city');
            $table->string('designation', 250)->nullable()->after('country');
            $table->string('hobbies', 250)->nullable()->after('designation');
            $table->string('interests', 250)->nullable()->after('hobbies');
            $table->string('gender')->nullable()->after('custom_option4');
        });
        Schema::table('timelines', function (Blueprint $table) {
            $table->string('sename', 250)->after('name')->nullable();
        });

        DB::table('user_profiles')->orderBy('id')->chunk(100, function ($profiles)
        {
            foreach ($profiles as $profile)
            {
                DB::table('users')
                    ->where('id', $profile->user_id)
                    ->update([
                        'birthday'      => $profile->birthday,
                        'gender'        => $this->genderToUser($profile->gender),
                        'city'          => $profile->city,
                        'country'       => $profile->country,
                        'designation'   => $profile->designation,
                        'hobbies'       => $profile->hobbies,
                        'interests'     => $profile->interests
                    ]);

                if (empty($profile->avatar)) {
                    $media_id = null;
                } else {
                    $media_id = DB::table('media')->where('source', $profile->avatar)->value('id');
                    if (empty($media_id)) {
                        $media_id = DB::table('media')->insertGetId(
                            [
                                'title'      => $profile->avatar,
                                'type'       => 'image',
                                'source'     => $profile->avatar,
                                'created_at' => \Carbon\Carbon::now(),
                                'updated_at' => \Carbon\Carbon::now()
                            ]
                        );
                    }
                }

                $timeline_id = DB::table('users')->where('id', $profile->user_id)->value('timeline_id');
                DB::table('timelines')
                    ->where('id', $timeline_id)
                    ->update([
                        'name'      => $profile->firstname,
                        'sename'    => $profile->lastname,
                        'avatar_id' => $media_id
                    ]);

            }
        });

        DB::table('user_profiles')->truncate();
    }

    private function genderToProfile($gender)
    {
        if (empty($gender)) return 'other';
        if ($gender === 'male') return 'male';
        if ($gender === 'female') return 'female';
        return 'other';
    }

    private function genderToUser($gender)
    {
        if (empty($gender)) return 'other';
        if ($gender === 'male') return 'male';
        if ($gender === 'female') return 'female';
        return 'other';
    }
}
