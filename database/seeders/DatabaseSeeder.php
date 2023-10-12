<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        $participants = \App\Models\Participant::factory(10)->create();

        $participants->each(function ($item) {
            $item->replicate()->fill(['contest_level_id' => 2])->save();
        });

        $this->call(ContestsTableSeeder::class);
        $this->call(ContestLevelsTableSeeder::class);
    }
}
