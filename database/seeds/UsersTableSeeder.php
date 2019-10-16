<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Http\Models\Race::updateOrCreate([
            'name' => 'Horde',
        ], [
            'name'        => 'Horde',
            'description' => 'Horde Description',
        ]);


        \App\Http\Models\User::updateOrCreate([
            'email' => 'destek@phpuzem.com',
        ], [
            'race_id'  => 1,
            'username' => 'halilcosdu',
            'email'    => 'destek@phpuzem.com',
            'password' => 12345678,
        ]);
    }
}
