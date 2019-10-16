<?php

use Illuminate\Database\Seeder;

class RacesTableSeeder extends Seeder
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

        \App\Http\Models\Race::updateOrCreate([
            'name' => 'Allies',
        ], [
            'name'        => 'Allies',
            'description' => 'Ally Description',
        ]);

    }
}
