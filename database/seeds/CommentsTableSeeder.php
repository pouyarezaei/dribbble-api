<?php

use App\Comment;
use App\Shot;
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
        Comment::truncate();
        Shot::all()->each(function ($shot) {
            $shot->comments()->save(factory(Comment::class)->make());
            $shot->comments()->save(factory(Comment::class)->make());
        });
    }
}
