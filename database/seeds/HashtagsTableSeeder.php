<?php

use App\Hashtag;
use Illuminate\Database\Seeder;

class HashtagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Populate dummy hashtags
        factory(Hashtag::class, 30)->create();
    }
}
