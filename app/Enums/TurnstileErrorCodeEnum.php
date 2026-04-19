<?php

namespace App\Enums;

enum TurnstileErrorCodeEnum: string
{
    case MISSING_SECRET    = 'missing-input-secret';
    case INVALID_SECRET    = 'invalid-input-secret';
    case MISSING_RESPONSE  = 'missing-input-response';
    case INVALID_RESPONSE  = 'invalid-input-response';
    case BAD_REQUEST       = 'bad-request';
    case DUPLICATE_REQUEST = 'timeout-or-duplicate';
    case INTERNAL_ERROR    = 'internal-error';
    case UNKNOWN_ERROR     = 'unknown-error';

    public function message(): string
    {
        return match ($this) {
            self::MISSING_SECRET    => 'Secret parameter not provided',
            self::INVALID_SECRET    => 'Secret key is invalid or expired',
            self::MISSING_RESPONSE  => 'Response parameter was not provided',
            self::INVALID_RESPONSE  => 'Token is invalid, malformed, or expired',
            self::BAD_REQUEST       => 'Request is malformed',
            self::DUPLICATE_REQUEST => 'Token has already been validated',
            self::INTERNAL_ERROR    => 'Internal error occurred',
            self::UNKNOWN_ERROR     => 'Unknown turnstile error occurred'
        };
    }
}
