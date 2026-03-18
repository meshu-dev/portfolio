<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{Repository, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('RepositoryController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads repositories list page', function () {
        // Arrange
        $repositories = Repository::where('user_id', UserEnum::ADMIN)->get();

        // Act
        $response = $this->get(route('repositories.list'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/Repositories')
                                      ->where('repositories', $repositories)
        );
    });

    it('adds a new repository', function () {
        // Arrange
        $params = ['name' => 'Laravel', 'url' => 'https://github.com/laravel/laravel'];

        // Act
        $response = $this->post(route('repositories.add', $params));

        // Assert
        $response->assertRedirect(route('repositories.list'))
                ->assertInertiaFlash('message', 'Repository has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing repository', function () {
        // Arrange
        $params = ['id' => Repository::where('name', 'CV')->first()->id];

        // Act
        $response = $this->delete(route('repositories.delete', $params));

        // Assert
        $response->assertRedirect(route('repositories.list'))
                ->assertInertiaFlash('message', 'Repository has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
