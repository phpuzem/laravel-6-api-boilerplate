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
        \App\Http\Models\User::create([
            'name'     => 'Halil Coşdu',
            'email'    => 'destek@phpuzem.com',
            'password' => 12345678,
        ]);
    }
}
