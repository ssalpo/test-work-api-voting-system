<?php

namespace Database\Seeders;

use App\Models\Contest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contests = collect([
            ['name' => 'Олимпиада по биологии']
        ]);

        $contests->each(fn($item) => Contest::create($item));
    }
}
