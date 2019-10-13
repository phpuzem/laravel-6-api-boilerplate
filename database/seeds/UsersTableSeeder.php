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
        \App\Http\Models\User::updateOrCreate([
            'email' => 'destek@phpuzem.com',
        ], [
            'username'     => 'halilcosdu',
            'email'    => 'destek@phpuzem.com',
            'password' => 12345678,
        ]);
    }
}
