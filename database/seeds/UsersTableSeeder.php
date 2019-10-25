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
        \App\Models\User::updateOrCreate([
            'email' => 'destek@phpuzem.com',
        ], [
            'name'     => 'Halil Coşdu',
            'email'    => 'destek@phpuzem.com',
            'password' => 12345678,
        ]);
    }
}
