<?php

use App\Image;
use App\Shot;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::truncate();
        Shot::all()->random()->each(function ($shot) {
            $shot->images()->save(factory(Image::class)->make());
            $shot->images()->save(factory(Image::class)->make());
        });
    }
}
