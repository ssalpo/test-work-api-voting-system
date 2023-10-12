<?php

namespace App\Exceptions;

use Exception;

class IncorrectVotingConditionForLevelException extends Exception
{
    protected $message = 'Условие для текущего этапа не определено!';
}
