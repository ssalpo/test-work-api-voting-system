<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class VotingNotStartedException extends Exception
{
    protected $message = 'Голосование еще не началось!';

    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
