<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('TagsTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('JobsTableSeeder');
        $this->call('ShotsTableSeeder');
        $this->call('ImagesTableSeeder');
        $this->call('GifsTableSeeder');
        $this->call('CommentsTableSeeder');

    }
}
