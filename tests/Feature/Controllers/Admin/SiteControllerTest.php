<?php

use App\Enums\{FlashTypeEnum, UserEnum};
use App\Http\Resources\SiteResource;
use App\Http\Resources\TypeResource;
use App\Models\{Site, Type, User};
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;

describe('SiteController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads sites list page', function () {
        // Arrange
        $sites = Site::where('user_id', UserEnum::ADMIN)->get();

        // Act
        $response = $this->get(route('sites.list'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Site/Sites')
                                      ->where('sites', $sites)
        );
    });

    it('loads view site page', function () {
        // Arrange
        $site = Site::where('user_id', UserEnum::ADMIN)->firstOrFail();

        // Act
        $response = $this->get(route('sites.view', ['id' => $site->id]));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Site/Site')
                                      ->where('site.data.id', $site->id)
                                      ->where('site.data.name', $site->name)
                                      ->where('site.data.url', $site->url)
                                      ->where('site.data.image_url', 'https://placehold.co/64x64')
                                      ->where('site.data.types.0.id', $site->types->first()->id)
                                      ->where('site.data.types.0.name', $site->types->first()->name)
        );
    });

    it('loads new site page', function () {
        // Act
        $response = $this->get(route('sites.new'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Site/Site')
        );
    });

    it('adds new site', function () {
        // Arrange
        $type = Type::where('name', 'CV')->firstOrFail();

        $params = [
            'name'  => 'Laravel',
            'url'   => 'https://laravel.com',
            'types' => [$type->id],
            'image' => UploadedFile::fake(),
        ];

        // Act
        $response = $this->post(route('sites.add', $params));

        // Assert
        $response->assertRedirect(route('sites.list'))
                ->assertInertiaFlash('message', 'Site has been added')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('edits existing site', function () {
        // Arrange
        $site = Site::where('user_id', UserEnum::ADMIN)->firstOrFail();
        $type = Type::where('name', 'CV')->firstOrFail();

        $params = [
            'id'    => $site->id,
            'name'  => 'Laravel',
            'url'   => 'https://laravel.com',
            'types' => [$type->id],
            'image' => UploadedFile::fake(),
        ];

        // Act
        $response = $this->put(route('sites.edit', $params));

        // Assert
        $response->assertRedirect(route('sites.list'))
                ->assertInertiaFlash('message', 'Site has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });

    it('deletes an existing site', function () {
        // Arrange
        $params = ['id' => Site::where('user_id', UserEnum::ADMIN)->where('name', 'Portfolio')->firstOrFail()->id];

        // Act
        $response = $this->delete(route('sites.delete', $params));

        // Assert
        $response->assertRedirect(route('sites.list'))
                ->assertInertiaFlash('message', 'Site has been deleted')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
