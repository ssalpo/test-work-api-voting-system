<?php

namespace App\Exceptions;

use Exception;

class AlreadyVoterForParticipantException extends Exception
{
    protected $message = 'Вы ранее уже проголосовали за текущего участника!';

    protected $code = 422;
}
