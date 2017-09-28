<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        'Airport'                       => 'Airport',
        'Automotive'                    => 'Automotive',
        'Bank/Financial Services'       => 'Bank/Financial Services',
        'Bar'                           => 'Bar',
        'Book Store'                    => 'Book Store',
        'Business Services'             => 'Business Services',
        'Church/Religious Organization' => 'Church/Religious Organization',
        'Club'                          => 'Club',
        'Concert Venue'                 => 'Concert Venue',
        'Doctor'                        => 'Doctor',
        'Education'                     => 'Education',
        'Event Planning/Event Services' => 'Event Planning/Event Services',
        'Home Improvement'              => 'Home Improvement',
        'Hotel'                         => 'Hotel',
        'Landmark'                      => 'Landmark',
        'category1'                     => 'category1',
        'category2'                     => 'category2',
        'category3'                     => 'category3',
        'category4'                     => 'category4',
        'category5'                     => 'category5',
        'category6'                     => 'category6',
        'category7'                     => 'category7',
        'category8'                     => 'category8',
        'category9'                     => 'category9',
        'category10'                    => 'category10',
        ];

        $i = 1;
        foreach ($categories as $key) {
            $category = Category::firstOrNew(['name' => $key, 'description' => 'description about '.$key, 'active' => '1', 'parent_id' => $i]);
            $category->save();
            $i++;
        }
    }
}
