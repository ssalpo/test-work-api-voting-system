<?php

namespace App\Exceptions;

use Exception;

class VotingNotStartedException extends Exception
{
    protected $message = 'Голосование еще не началось!';
}
