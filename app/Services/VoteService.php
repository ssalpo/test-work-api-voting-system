<?php

namespace App\Services;

use App\Exceptions\AlreadyVoterForParticipantException;
use App\Exceptions\IncorrectVotingConditionForLevelException;
use App\Exceptions\MaxVotingConditionExpiredException;
use App\Exceptions\VotingNotStartedException;
use App\Models\Contest;
use App\Models\ContestLevel;
use App\Models\Vote;
use Illuminate\Support\Arr;

class VoteService
{
    /**
     * Добавление голоса
     *
     * @param array $data
     * @return Vote
     *
     * @throws VotingNotStartedException
     * @throws AlreadyVoterForParticipantException
     * @throws MaxVotingConditionExpiredException
     * @throws IncorrectVotingConditionForLevelException
     */
    public function store(array $data): Vote
    {
        $this->setCurrentContestLevel($data);

        $this->checkIsVotingStarted($data);

        $this->checkIsAlreadyVotedForParticipant($data);

        $this->checkIsMaxVotingConditionExpired($data);

        return Vote::create($data);
    }

    private function setCurrentContestLevel(array &$data): void
    {
        $data['contest_level_id'] = ContestLevel::getStartedByContestId(
            $data['contest_id'],
            now()
        )->id;
    }

    /**
     * @throws VotingNotStartedException
     */
    private function checkIsVotingStarted(array $data): void
    {
        $isContestStarted = ContestLevel::checkIsStartedByContest($data['contest_id'], now());

        if (!$isContestStarted) {
            throw new VotingNotStartedException;
        }
    }

    /**
     * @throws AlreadyVoterForParticipantException
     */
    private function checkIsAlreadyVotedForParticipant(array $data): void
    {
        $alreadyVotedForParticipant = Vote::whereParticipantId($data['participant_id'])
            ->whereUserId($data['user_id'])
            ->whereContestLevelId($data['contest_level_id'])
            ->count();

        if ($alreadyVotedForParticipant) {
            throw new AlreadyVoterForParticipantException;
        }
    }

    /**
     * @throws MaxVotingConditionExpiredException
     * @throws IncorrectVotingConditionForLevelException
     */
    private function checkIsMaxVotingConditionExpired(array $data): void
    {
        $currentContestLevelNumber = ContestLevelService::getCurrentLevelNumberByContest($data['contest_id']);

        $voteCount = Vote::whereUserId($data['user_id'])
            ->whereContestLevelId($data['contest_level_id'])
            ->count();

        $votingCondition = Arr::get(Contest::VOTING_CONDITION_BY_LEVEL, $currentContestLevelNumber);

        if (!$votingCondition) {
            throw new IncorrectVotingConditionForLevelException;
        }

        if ($voteCount >= $votingCondition) {
            throw new MaxVotingConditionExpiredException("Вы уже голосовали ранее. Максимально количество голосований должно быть равно $votingCondition!");
        }
    }
}
