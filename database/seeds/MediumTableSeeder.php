<?php

use App\Media;
use Illuminate\Database\Seeder;

class MediumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Populate dummy medium
        factory(Media::class, 80)->create();
    }
}
