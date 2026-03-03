<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{User, WorkExperience};
use Illuminate\Support\Carbon;
use Inertia\Testing\AssertableInertia as Assert;

describe('WorkExperienceController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads work experience list page', function () {
        // Arrange
        $workExperiences = WorkExperience::select('id', 'title', 'company', 'location')
                                         ->where('user_id', UserEnum::ADMIN)
                                         ->get();

        // Act
        $response = $this->get(route('work-experiences.list'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('WorkExperiences')
                                      ->where('workExperiences', $workExperiences)
        );
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

    it('adds new work experience', function () {
        // Arrange
        $params = [
            'title'            => 'Java Developer',
            'company'          => 'Strikeforce',
            'location'         => 'Manchester, UK',
            'is_current'       => false,
            'start_date'       => Carbon::createFromDate(2020, 5, 1)->format('Y-m-d'),
            'end_date'         => Carbon::createFromDate(2025, 9, 10)->format('Y-m-d'),
            'description'      => 'Worked as the main Java developer for their IT system',
            'responsibilities' => ['Worked on various projects for the admin system', 'Fixed bugs when raised by customer service'],
            'active'           => true,
        ];

        // Act
        $response = $this->post(route('work-experiences.add', $params));

        // Assert
        $response->assertRedirect(route('work-experiences.list'))
                ->assertInertiaFlash('message', 'Work experience has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('edits existing work experience', function () {
        // Arrange
        $workExperience = WorkExperience::first();

        $params = [
            'id'               => $workExperience->id,
            'title'            => 'Java Developer',
            'company'          => 'Strikeforce',
            'location'         => 'Manchester, UK',
            'is_current'       => false,
            'start_date'       => Carbon::createFromDate(2020, 5, 1)->format('Y-m-d'),
            'end_date'         => Carbon::createFromDate(2025, 9, 10)->format('Y-m-d'),
            'description'      => 'Worked as the main Java developer for their IT system',
            'responsibilities' => ['Worked on various projects for the admin system', 'Fixed bugs when raised by customer service'],
            'active'           => true,
        ];

        // Act
        $response = $this->put(route('work-experiences.edit', $params));

        // Assert
        $response->assertRedirect(route('work-experiences.list'))
                ->assertInertiaFlash('message', 'Work experience has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing work experience', function () {
        // Arrange
        $params = ['id' => WorkExperience::first()->id];

        // Act
        $response = $this->delete(route('work-experiences.delete', $params));

        // Assert
        $response->assertRedirect(route('work-experiences.list'))
                ->assertInertiaFlash('message', 'Work experience has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
