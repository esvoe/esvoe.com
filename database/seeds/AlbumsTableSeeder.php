<?php

use App\Album;
use Illuminate\Database\Seeder;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Album::class, 60)->create();

        //Seeding album photos
        $faker = Faker\Factory::create();
        $albums = Album::all();

        foreach ($albums as $album) {
            $photos = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $album->photos()->sync($photos);
        }
    }
}
