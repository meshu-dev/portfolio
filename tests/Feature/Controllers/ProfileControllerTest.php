<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Text, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('ProfileController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads profile page', function () {
        // Arrange
        $textData = Text::where('user_id', UserEnum::ADMIN)->get();
        $textData = $textData->keyBy('name');

        $intro    = str_replace('##years_worked##', 15, $textData->get('intro')['value']);
        $location = $textData->get('location')['value'];

        // Act
        $response = $this->get(route('profile.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Cv/Profile')
                                    ->where('intro', $intro)
                                    ->where('location', $location)
        );
    });

    it('edits profile', function () {
        // Arrange
        $params = [
            'intro'    => "I've switched to being a Java developer",
            'location' => 'Nottingham, UK'
        ];

        // Act
        $response = $this->put(route('profile.edit', $params));

        // Assert
        $response->assertRedirect(route('profile.view'))
                ->assertInertiaFlash('message', 'Profile has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
