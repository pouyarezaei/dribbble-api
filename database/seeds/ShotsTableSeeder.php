<?php

use App\Shot;
use App\User;
use Illuminate\Database\Seeder;

class ShotsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shot::truncate();

        User::all()->where('role', '=', 'designer')->each(function ($user) {
            $user->shots()->save(factory(Shot::class)->make());
            $user->shots()->save(factory(Shot::class)->make());
        });
    }
}
