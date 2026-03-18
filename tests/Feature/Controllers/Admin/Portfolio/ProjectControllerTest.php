<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Project, Repository, Technology, User};
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;

describe('ProjectController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads projects list page', function () {
        // Arrange
        $projects = Project::where('user_id', UserEnum::ADMIN)->get();

        // Act
        $response = $this->get(route('projects.list'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/Projects')
                                      ->where('projects', $projects)
        );
    });

    it('loads view project page', function () {

    })->skip();

    it('loads new project page', function () {
        // Act
        $response = $this->get(route('projects.new'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/Project')
        );
    });

    it('adds new project', function () {
        // Arrange
        $repository = Repository::where('user_id', UserEnum::ADMIN)->firstOrFail();
        $technology = Technology::where('user_id', UserEnum::ADMIN)->firstOrFail();

        $params = [
            'name'          => 'Laravel',
            'description'   => 'Laravel project',
            'url'           => 'https://laravel.com',
            'repositories'  => [$repository->id],
            'technologies'  => [$technology->id],
            'image' => UploadedFile::fake(),
        ];

        // Act
        $response = $this->post(route('projects.add', $params));

        // Assert
        $response->assertRedirect(route('projects.list'))
                ->assertInertiaFlash('message', 'Project has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('edits existing project', function () {
        // Arrange
        $project    = Project::where('user_id', UserEnum::ADMIN)->firstOrFail();
        $repository = Repository::where('user_id', UserEnum::ADMIN)->firstOrFail();
        $technology = Technology::where('user_id', UserEnum::ADMIN)->firstOrFail();

        $params = [
            'id'            => $project->id,
            'name'          => 'Laravel',
            'description'   => 'Laravel project',
            'url'           => 'https://laravel.com',
            'repositories'  => [$repository->id],
            'technologies'  => [$technology->id],
            'image' => UploadedFile::fake(),
        ];

        // Act
        $response = $this->put(route('projects.edit', $params));

        // Assert
        $response->assertRedirect(route('projects.list'))
                ->assertInertiaFlash('message', 'Project has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing project', function () {
        // Arrange
        $params = ['id' => Project::where('user_id', UserEnum::ADMIN)->firstOrFail()->id];

        // Act
        $response = $this->delete(route('projects.delete', $params));

        // Assert
        $response->assertRedirect(route('projects.list'))
                ->assertInertiaFlash('message', 'Project has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
