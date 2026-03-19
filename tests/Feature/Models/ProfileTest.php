<?php

use App\Actions\Portfolio\GetYearsWorkedAction;
use App\Enums\DynamicValueEnum;
use App\Models\Profile;

describe('Models\Profile tests', function () {
    it('retrieves the formatted intro value', function () {
        // Arrange
        $profile = Profile::firstOrFail();

        $value = str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            (string) resolve(GetYearsWorkedAction::class)->execute(),
            $profile->intro
        );

        // Act
        $result = $profile->getFormattedIntroAttribute();

        // Assert
        expect($result)->toBe($value);
    });
});
