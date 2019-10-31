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
        factory(\App\Comment::class, 100)->make()->each(function ($comment){
            $comment->user_id= User::inRandomOrder()->first()->id;
            $comment->post_id= Post::inRandomOrder()->first()->id;
            $comment->save();
        });
    }
}
