<?php

use App\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Populate dummy announcements
        factory(Announcement::class, 20)->create()
        ->each(function ($announcement) {
            $faker = Faker\Factory::create();

            $views = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20'], $faker->numberBetween(1, 20));

            $announcement->users()->sync($views);
        });
    }
}
