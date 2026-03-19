<?php

use App\Libraries\Faker;

describe('Libraries\Faker tests', function () {
    it('retrieves a placeholder image URL', function () {
        // Arrange
        $faker = resolve(Faker::class);
        $placeholderUrl = config('app.faker_placeholder_url');

        // Act
        $result = $faker->placeholderImageUrl();

        // Assert
        expect($result)->toBe($placeholderUrl . '/640x480');
    });
});
