<?php

use App\Gif;
use App\Shot;
use Illuminate\Database\Seeder;

class GifsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gif::truncate();
        Shot::all()->random()->each(function ($shot) {
            $shot->gifs()->save(factory(Gif::class)->make());
            $shot->gifs()->save(factory(Gif::class)->make());
        });
    }
}
