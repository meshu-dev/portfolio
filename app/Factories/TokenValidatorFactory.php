<?php

namespace App\Factories;

use App\Actions\Google\ValidateReCaptchaTokenAction;
use App\Actions\Cloudflare\ValidateTrunstilesTokenAction;
use App\Enums\TypeEnum;

class TokenValidatorFactory
{
    public function make(TypeEnum $type)
    {
        return match ($type) {
            TypeEnum::CV        => resolve(ValidateReCaptchaTokenAction::class),
            TypeEnum::PORTFOLIO => resolve(ValidateTrunstilesTokenAction::class),
        };
    }
}
