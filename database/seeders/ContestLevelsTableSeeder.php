<?php

namespace Database\Seeders;

use App\Models\ContestLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestLevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contestLevels = collect([
            [
                'contest_id' => 1,
                'start_date' => now()->subDays(5),
                'end_date' => now()->addDays(5),
            ],
            [
                'contest_id' => 1,
                'start_date' => now()->addDays(7),
                'end_date' => now()->addDays(21),
            ],
        ]);

        $contestLevels->each(fn($item) => ContestLevel::create($item));
    }
}
