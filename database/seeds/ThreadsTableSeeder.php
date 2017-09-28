<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Timeline;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;

class ThreadsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = [];
        $faker = Faker\Factory::create();
        //create usable accounts
        for ($i = 1; $i < 10; $i++)
        {

            // create timeline
            $timeline = Timeline::create([
                'username'  => 'dev' . $i . 'user',
                'name'      => 'Develop User ' . $i,
                'about'     => 'User for develop',
                'type'      => 'user'
            ]);

            // create user
            $user = User::create([
                'timeline_id'       => $timeline->id,
                'email'             => 'devuser' . $i . '@dev.dev',
                'verification_code' => str_random(18),
                'remember_token'    => str_random(10),
                'password'          => Hash::make('1234'),
                'city'              => $faker->city,
                'country'           => $faker->country,
                'gender'            => $faker->randomElement($array = ['male', 'female']),
                'email_verified'    => 1
            ]);
            $userIds[] = $user->id;

            // create user settings
            $user_settings = [
                'user_id'               => $user->id,
                'confirm_follow'        => 'no',
                'follow_privacy'        => 'everyone',
                'comment_privacy'       => 'everyone',
                'timeline_post_privacy' => 'everyone',
                'post_privacy'          => 'everyone',
                'message_privacy'       => 'everyone'
            ];
            DB::table('user_settings')->insert($user_settings);
            $user->roles()->attach(2);
        }

        // create threads
        for ($i = 1; $i < 71; $i++)
        {
            $subject = $faker->randomElement(['', $faker->text($faker->numberBetween(5, 15))]);

            if ($subject) {
                $participantsCount = $faker->numberBetween(1, 9);
            } else {
                $participantsCount = 2;
            }
            shuffle($userIds);
            $participantUserIds = array_slice($userIds, 0, $participantsCount);

            // thread
            $thread = Thread::create(['subject' => $subject, 'type' => ($subject ? 'group' : 'dialog')]);

            // participants
            foreach ($participantUserIds as $userId)
            {
                Participant::create([
                    'thread_id' => $thread->id,
                    'user_id'   => $userId,
                    'last_read' => 0
                ]);

                // messages
                $messagesCount = $faker->numberBetween(1, 100);
                for ($m = 0; $m < $messagesCount; $m++) {
                    Message::create([
                        'thread_id'     => $thread->id,
                        'user_id'       => $userId,
                        'body'          => $faker->text($faker->numberBetween(5, 100)),
                        'created_at'    => $faker->dateTimeBetween('-1 year', 'now')
                    ]);
                }
            }
            $lastMessageAt = Message::where('thread_id', $thread->id)->latest()->value('created_at');
            $thread->updated_at = $lastMessageAt;
            $thread->save();
        }
    }
}
