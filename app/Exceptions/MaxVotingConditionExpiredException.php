<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class MaxVotingConditionExpiredException extends Exception
{
    protected $code = Response::HTTP_UNPROCESSABLE_ENTITY;
}
