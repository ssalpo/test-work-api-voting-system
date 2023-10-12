<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AlreadyVoterForParticipantException extends Exception
{
    protected $message = 'Вы ранее уже проголосовали за текущего участника!';

    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
