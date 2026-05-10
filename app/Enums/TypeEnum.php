<?php

namespace App\Enums;

enum TypeEnum: int
{
    case CV = 1;
    case PORTFOLIO = 2;

    public function key(): string
    {
        return match ($this) {
            self::CV => 'cv',
            self::PORTFOLIO => 'portfolio'
        };
    }
}
