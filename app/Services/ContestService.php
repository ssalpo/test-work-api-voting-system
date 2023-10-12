<?php

namespace App\Services;

use App\Models\Contest;

class ContestService
{
    public function store(array $data): Contest
    {
        $contest = Contest::create($data);

        // @TODO перед тем как создать, нужно придумать логику проверки последовательности для contest levels
        collect($data['levels'])->each(
            fn($item) => $contest->contestLevels()->create($item)
        );

        return $contest->load('contestLevels');
    }
}
