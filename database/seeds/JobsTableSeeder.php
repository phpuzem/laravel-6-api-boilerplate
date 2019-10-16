<?php

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
        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 1,
            'name'    => 'Warrior',
        ], [
            'name'        => 'Warrior',
            'description' => 'Warrior Horde Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 1,
            'name'    => 'Hunter',
        ], [
            'name'        => 'Hunter',
            'description' => 'Hunter Horde Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 1,
            'name'    => 'Magician',
        ], [
            'name'        => 'Magician',
            'description' => 'Magician Horde Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 1,
            'name'    => 'Priest',
        ], [
            'name'        => 'Priest',
            'description' => 'Priest Horde Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 2,
            'name'    => 'Warrior',
        ], [
            'name'        => 'Warrior',
            'description' => 'Warrior Ally Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 2,
            'name'    => 'Hunter',
        ], [
            'name'        => 'Hunter',
            'description' => 'Hunter Ally Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 2,
            'name'    => 'Magician',
        ], [
            'name'        => 'Magician',
            'description' => 'Magician Ally Description',
        ]);

        \App\Http\Models\Job::updateOrCreate([
            'race_id' => 2,
            'name'    => 'Priest',
        ], [
            'name'        => 'Priest',
            'description' => 'Priest Ally Description',
        ]);
    }
}
