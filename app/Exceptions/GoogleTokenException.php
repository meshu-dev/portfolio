<?php

namespace App\Exceptions;

use Exception;

class GoogleTokenException extends Exception
{
    public function __construct(string $code)
    {
        parent::__construct($this->getMessageFromCode($code));
    }

    protected function getMessageFromCode(string $code): string
    {
        $errorMessages = config('services.google.recaptcha.error_messages');

        if ($errorMessages[$code]) {
            return $errorMessages[$code];
        }
        return $errorMessages['default'];
    }
}
