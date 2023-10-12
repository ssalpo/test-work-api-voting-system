<?php

namespace App\Services;

use App\Models\Contest;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class ContestService
{
    /**
     * @throws \Exception
     */
    public function store(array $data): Contest
    {
        $contest = Contest::create($data);


        if (!$this->isContestLevelDatesCorrect($data['levels'])) {
            throw new \Exception('Некорректные порядки по датам!', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        collect($data['levels'])->each(
            fn($item) => $contest->contestLevels()->create($item)
        );

        return $contest->load('contestLevels');
    }

    /**
     * Проверяет корректность заполнения последовательности даты
     * для спаска этапов голосования
     *
     * @param array $levels
     * @return bool
     */
    public function isContestLevelDatesCorrect(array $levels)
    {
        if (count($levels) <= 1) {
            return true;
        }

        foreach ($levels as $index => $item) {
            if ($index === 0) {
                continue;
            }

            $prevEndDate = Carbon::parse($levels[$index - 1]['end_date']);

            $currentStartDate = Carbon::parse($item['start_date']);
            $currentEndDate = Carbon::parse($item['end_date']);

            if (
                ($prevEndDate->gt($currentStartDate) || $prevEndDate->gt($currentEndDate)) ||
                $currentStartDate->gt($currentEndDate)
            ) {
                return false;
            }
        }

        return true;
    }
}
