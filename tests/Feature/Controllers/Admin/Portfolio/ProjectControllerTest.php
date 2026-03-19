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
        // Arrange
        $project = Project::where('user_id', UserEnum::ADMIN)->firstOrFail();

        // Act
        $response = $this->get(route('projects.view', ['id' => $project->id]));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/Project')
                                      ->where('project.data.id', $project->id)
                                      ->where('project.data.name', $project->name)
                                      ->where('project.data.description', $project->description)
                                      ->where('project.data.url', $project->url)
                                      ->where('project.data.image_url', '/storage/https://placehold.co/512x512')
                                      ->where('project.data.repositories.0.id', $project->repositories->first()->id)
                                      ->where('project.data.repositories.0.name', $project->repositories->first()->name)
                                      ->where('project.data.repositories.0.url', $project->repositories->first()->url)
                                      ->where('project.data.technologies.0.id', $project->technologies->first()->id)
                                      ->where('project.data.technologies.0.name', $project->technologies->first()->name)
        );
    });

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
