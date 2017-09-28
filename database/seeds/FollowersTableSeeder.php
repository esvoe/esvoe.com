<?php

use App\Follower;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Populate dummy followers
        factory(Follower::class, 20)->create();
    }
}
