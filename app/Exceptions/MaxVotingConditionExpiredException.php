<?php

namespace App\Exceptions;

use Exception;

class MaxVotingConditionExpiredException extends Exception
{
    protected $code = 422;
}
