<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Skill, Technology, Text, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('TechnologyController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads skills page', function () {
        /*
        // Arrange
        $textData = Text::where('user_id', UserEnum::ADMIN)->get();
        $textData = $textData->keyBy('name');

        $intro    = str_replace('##years_worked##', 15, $textData->get('intro')['value']);
        $location = $textData->get('location')['value'];

        // Act
        $response = $this->get(route('profile.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Skills')
                                    ->where('skills', $intro)
                                    ->where('technologies', $location)
        ); */
    })->skip();

    it('adds a new technology', function () {
        // Arrange
        $params = ['name' => 'Rust'];

        // Act
        $response = $this->post(route('technologies.add', $params));

        // Assert
        $response->assertRedirect('/')
                ->assertInertiaFlash('message', 'Technology has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing technology', function () {
        // Arrange
        $params = ['id' => Technology::first()->id];

        // Act
        $response = $this->delete(route('technologies.delete', $params));

        // Assert
        $response->assertRedirect('/')
                ->assertInertiaFlash('message', 'Technology has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
