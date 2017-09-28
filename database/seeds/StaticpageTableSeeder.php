<?php

use App\StaticPage;
use Illuminate\Database\Seeder;

class StaticpageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $pages = ['about'            => 'about',
                        'privacy'    => 'privacy',
                        'disclaimer' => 'disclaimer',
                        'terms'      => 'terms', ];

        foreach ($pages as $key) {
            $account = StaticPage::firstOrNew(['title' => $key]);
            $account->description = $faker->paragraph;
            $account->active = 1;
            $account->save();
        }
    }
}
