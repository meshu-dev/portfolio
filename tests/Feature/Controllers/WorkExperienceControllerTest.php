<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{User, WorkExperience};
use Inertia\Testing\AssertableInertia as Assert;

describe('WorkExperienceController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads new work experience page', function () {
        // Act
        $response = $this->get(route('work-experiences.new'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('WorkExperience')
        );
    });

    it('loads view work experience page', function () {
        // Arrange
        $params = ['id' => WorkExperience::first()->id];

        // Act
        $response = $this->get(route('work-experiences.view', $params));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('WorkExperience')
        );
    });

    it('deletes an existing work experience', function () {
        // Arrange
        $params = ['id' => WorkExperience::first()->id];

        // Act
        $response = $this->delete(route('work-experiences.delete', $params));

        // Assert
        $response->assertRedirect('/')
                ->assertInertiaFlash('message', 'Work experience has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
