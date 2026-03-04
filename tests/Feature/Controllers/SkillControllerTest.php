<?php

use App\Enums\{FlashTypeEnum, SkillEnum, UserEnum};
use App\Models\{Skill, Technology, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('SkillController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads skills page', function () {
        // Arrange
        $technologies = Technology::where('user_id', UserEnum::ADMIN)
                            ->orderBy('name')
                            ->get();

        $skills = Skill::with(['technologies'])
            ->where('user_id', UserEnum::ADMIN)
            ->whereIn('name', [
                SkillEnum::BACKEND->value,
                SkillEnum::FRONTEND->value,
                SkillEnum::FRAMEWORKS->value,
                SkillEnum::MISC->value,
            ])
            ->get();

        // Act
        $response = $this->get(route('skills.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Skills')
                                    ->where('skills', $skills)
                                    ->where('technologies', $technologies)
        );
    });

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
        $response->assertRedirect(route('skills.view'))
                ->assertInertiaFlash('message', 'Skills have been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
