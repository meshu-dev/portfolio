<?php

namespace App\Actions\Portfolio;

use App\Enums\DynamicValueEnum;

class GetDynamicTextAction
{
    /**
     * @return string
     */
    public function execute(?string $text): string
    {
        return str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            (string) resolve(GetYearsWorkedAction::class)->execute(),
            $text ?? ''
        );
    }
}
