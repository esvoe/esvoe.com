<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Populate dummy posts
        factory(Post::class, 260)->create();

        //Seeding post follows
        $faker = Faker\Factory::create();
        $posts = Post::all();

        foreach ($posts as $post) {
            $follows = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $post->notifications_user()->sync($follows);
        }

        //Seeding post likes
        foreach ($posts as $post) {
            $likes = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $post->users_liked()->sync($likes);
        }

        //Seeding post media
        foreach ($posts as $post) {
            $media = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $post->images()->sync($media);
        }

        //Seeding post shares
        foreach ($posts as $post) {
            $shares = $faker->randomElements(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '35', '36', '37', '38'], $faker->numberBetween(1, 3));

            $post->users_shared()->sync($shares);
        }

        //Seeding post reports
        // foreach ($posts as $post) {

        //     $reports = $faker->randomElements(array ('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33','34','35','36','37','38'), $faker->numberBetween(1,3));

        //     $syncReports = array();
        //     foreach ($reports as $key => $value) {
        //         $syncReports[$value]  = array('status'=> 'approved');
        //     }

        //     $post->reports()->sync($syncReports);

        // }
    }
}
