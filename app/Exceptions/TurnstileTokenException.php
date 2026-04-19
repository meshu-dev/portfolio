<?php

namespace App\Exceptions;

use App\Enums\TurnstileErrorCodeEnum;
use Exception;

class TurnstileTokenException extends Exception
{
    public function __construct(string $code)
    {
        parent::__construct(TurnstileErrorCodeEnum::from($code)->message());
    }
}
