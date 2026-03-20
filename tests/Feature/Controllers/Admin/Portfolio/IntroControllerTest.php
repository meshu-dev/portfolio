<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Intro, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('IntroController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads intro page', function () {
        // Arrange
        $intro = Intro::where('user_id', UserEnum::ADMIN)->firstOrFail();

        // Act
        $response = $this->get(route('intro.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/Intro')
                                      ->where('line1', $intro->line1)
                                      ->where('line2', $intro->line2)
        );
    });

    it('edits intro', function () {
        // Arrange
        $params = [
            'line1' => 'This is the first line of the intro',
            'line2' => 'This is the second line of the intro',
        ];

        // Act
        $response = $this->put(route('intro.edit', $params));

        // Assert
        $response->assertRedirect(route('intro.view'))
                ->assertInertiaFlash('message', 'Intro has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
