<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        //$posts = App\Post::where('active', 1)->get();
        $posts = App\Post::all();

        $posts->each(function ($post){
            factory(\App\Comment::class, rand(1,10))->make()->each(function ($comment) use ($post){
                $comment->user_id= User::inRandomOrder()->first()->id;
                $comment->post_id= $post->id;
                $comment->save();
            });
        });
    }
}
