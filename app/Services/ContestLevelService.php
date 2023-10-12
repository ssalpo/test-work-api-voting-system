<?php

namespace App\Services;

use App\Models\Contest;
use App\Models\ContestLevel;
use Carbon\Carbon;

class ContestLevelService
{
    /**
     * Возвращает текущий номер этап конкурса
     *
     * @param int $contestId
     * @param Carbon|null $date
     * @return int
     */
    public static function getCurrentLevelNumberByContest(int $contestId, Carbon $date = null): int
    {
        $levels = ContestLevel::where('contest_id', $contestId)
            ->where('end_date', '<', $date ?? now())
            ->count();

        return $levels < Contest::MAX_LEVEL ? $levels + 1 : Contest::MAX_LEVEL;
    }
}
