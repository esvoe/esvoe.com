<?php

use App\Post;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        //Populate dummy comments
        $posts = Post::all();

        foreach ($posts as $post) {
            $comments = [
                'post_id'     => $faker->numberBetween($min = 1, $max = 60),
                'description' => $faker->text,
                'user_id'     => $faker->numberBetween($min = 1, $max = 38), ];

            $postComments = DB::table('comments')->insert($comments);
        }

        $comments = DB::table('comments')->select('id')->get();
        foreach ($comments as $comment) {
            $likes = [
                'user_id'    => $faker->numberBetween($min = 1, $max = 38),
                'comment_id' => $faker->numberBetween($min = 1, $max = 60), ];

            $postLikes = DB::table('comment_likes')->insert($likes);
        }
    }
}
