<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RacesTableSeeder::class);
        $this->call(JobsTableSeeder::class);
       // $this->call(UsersTableSeeder::class);
    }
}
