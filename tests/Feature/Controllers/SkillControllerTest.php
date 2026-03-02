<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Skill, Technology, Text, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('SkillController tests', function () {
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

    it('edits skills', function () {
        // Arrange
        $params = [
            'skills' => [
                ['id' => Skill::first()->id, 'technologies' => [Technology::first()->id]]
            ]
        ];

        // Act
        $response = $this->put(route('skills.edit', $params));

        // Assert
        $response->assertRedirect('/')
                ->assertInertiaFlash('message', 'Skills have been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
