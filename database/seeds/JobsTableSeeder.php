<?php

use App\Job;
use App\User;
use Illuminate\Database\Seeder;

class JobsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Job::truncate();
        User::all()->where('role', '=', 'employee')->each(function ($user) {
            $user->jobs()->save(factory(Job::class)->make());
            $user->jobs()->save(factory(Job::class)->make());
        });
    }
}
