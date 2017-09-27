<?php

use App\Group;
use App\Page;
use App\Timeline;
use App\User;
use Illuminate\Database\Seeder;

class TimelinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Create admin account
        $account = Timeline::firstOrNew(['username' => 'bootstrapguru']);
        $account->username = 'bootstrapguru';
        $account->name = 'Bootstrap Guru';
        $account->about = 'Some text about me';
        $account->type = 'user';
        $account->save();

        $user = User::create([
            'timeline_id'       => 1,
            'email'             => 'admin@bootstrapguru.com',
            'verification_code' => str_random(18),
            'remember_token'    => str_random(10),
            'password'          => Hash::make('socialite'),
            'city'              => 'Hyderabad',
            'country'           => 'India',
            'gender'            => 'male',
            'email_verified'    => 1,
        ]);

        $user_settings = [
            'user_id'               => $user->id,
            'confirm_follow'        => 'no',
            'follow_privacy'        => 'everyone',
            'comment_privacy'       => 'everyone',
            'timeline_post_privacy' => 'everyone',
            'post_privacy'          => 'everyone',
            'message_privacy'       => 'everyone', ];

        $userSettings = DB::table('user_settings')->insert($user_settings);

        $user->roles()->attach(1);


        // Create user
        $account = Timeline::firstOrNew(['username' => 'vijay']);
        $account->username = 'vijay';
        $account->name = 'Vijay Kumar';
        $account->about = 'Some text about me';
        $account->type = 'user';
        $account->save();

        $user = User::create([
            'timeline_id'       => 2,
            'email'             => 'contact@vijaykumar.me',
            'verification_code' => str_random(18),
            'remember_token'    => str_random(10),
            'password'          => Hash::make('socialite'),
            'city'              => 'Hyderabad',
            'country'           => 'India',
            'gender'            => 'male',
            'email_verified'    => 1,
        ]);
        $user_settings = [
                    'user_id'               => $user->id,
                    'confirm_follow'        => 'no',
                    'follow_privacy'        => 'everyone',
                    'comment_privacy'       => 'everyone',
                    'timeline_post_privacy' => 'everyone',
                    'post_privacy'          => 'everyone',
                    'message_privacy'       => 'everyone', ];

        $userSettings = DB::table('user_settings')->insert($user_settings);

        //Populate dummy accounts
        factory(Timeline::class, 90)->create()
           ->each(function ($timeline) {
               $faker = Faker\Factory::create();

            if ($timeline->id < 40) {
                //Seeding users
                $user = User::create([
                'timeline_id'       => $timeline->id,
                'email'             => $faker->safeEmail,
                'verification_code' => str_random(18),
                'remember_token'    => str_random(10),
                'password'          => Hash::make('socialite'),
                'city'              => $faker->city,
                'country'           => $faker->country,
                'gender'            => $faker->randomElement($array = ['male', 'female']),
                'email_verified'    => 1,
                ]);

             //Seeding user settings
                $user_settings = [
                'user_id'               => $user->id,
                'confirm_follow'        => 'no',
                'follow_privacy'        => 'everyone',
                'comment_privacy'       => 'everyone',
                'timeline_post_privacy' => 'everyone',
                'post_privacy'          => 'everyone',
                'message_privacy'       => 'everyone', ];

                $userSettings = DB::table('user_settings')->insert($user_settings);
                $timeline->type = 'user';
                $timeline->save();
            } elseif ($timeline->id < 60) {
                $page = Page::create([
                'timeline_id'           => $timeline->id,
                'address'               => $faker->address,
                'category_id'           => $faker->numberBetween($min = 1, $max = 20),
                'message_privacy'       => 'everyone',
                'timeline_post_privacy' => 'everyone',
                'member_privacy'        => 'everyone',
                ]);
                $timeline->type = 'page';
                $timeline->save();

                //Seeding page likes
                $likes = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'], $faker->numberBetween(1, 3));

                $page->likes()->sync($likes);

                //Seeding page users
                $users = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'], $faker->numberBetween(1, 3));

                $sycnUsers = [];
                foreach ($users as $key => $value) {
                    $sycnUsers[$value] = ['role_id' => $faker->numberBetween(1, 3), 'active' => 1];
                }

                $page->users()->sync($sycnUsers);
            } else {
                $group = Group::create([
                'timeline_id'    => $timeline->id,
                'type'           => $faker->randomElement($array = ['open', 'closed', 'secret']),
                'member_privacy' => 'everyone',
                'post_privacy'   => 'members',
                'event_privacy'  => 'only_admins',
                ]);
                $timeline->type = 'group';
                $timeline->save();

                //Seeding group users
                $users = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'], $faker->numberBetween(1, 3));

                $sycnUsers = [];
                foreach ($users as $key => $value) {
                    $sycnUsers[$value] = ['role_id' => $faker->numberBetween(1, 3), 'status' => 'approved'];
                }

                $group->users()->sync($sycnUsers);
            }
           });

            //Seeding Followers
            $faker = Faker\Factory::create();
        $users = User::all();

        foreach ($users as $user) {
            $followers = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $sycnFollowers = [];
            foreach ($followers as $key => $value) {
                $sycnFollowers[$value] = ['status' => 'approved'];
            }

            $user->followers()->sync($sycnFollowers);
        }
    }
}
