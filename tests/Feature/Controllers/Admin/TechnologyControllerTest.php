<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Technology, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('TechnologyController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads technologies page', function () {
        // Arrange
        $technologies = Technology::where('user_id', UserEnum::ADMIN)
                            ->orderBy('name')
                            ->get();

        // Act
        $response = $this->get(route('technologies.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Technologies')
                                      ->where('technologies', $technologies)
        );
    });

    it('adds a new technology', function () {
        // Arrange
        $params = ['name' => 'Rust'];

        // Act
        $response = $this->post(route('technologies.add', $params));

        // Assert
        $response->assertRedirect(route('technologies.view'))
                ->assertInertiaFlash('message', 'Technology has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing technology', function () {
        // Arrange
        $params = ['id' => Technology::where('name', 'Objective-C')->first()->id];

        // Act
        $response = $this->delete(route('technologies.delete', $params));

        // Assert
        $response->assertRedirect(route('technologies.view'))
                ->assertInertiaFlash('message', 'Technology has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
