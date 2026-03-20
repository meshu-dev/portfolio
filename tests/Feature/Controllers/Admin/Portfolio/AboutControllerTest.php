<?php

use App\Actions\File\GetFileUrlAction;
use App\Enums\{FlashTypeEnum, UserEnum};
use App\Models\{About, Technology, User};
use Inertia\Testing\AssertableInertia as Assert;

describe('AboutController tests', function () {
    beforeEach(function () {
        $this->actingAs(User::find(UserEnum::ADMIN));
    });

    it('loads about page', function () {
        // Arrange
        $about = About::where('user_id', UserEnum::ADMIN)->firstOrFail();
        $imageUrl = $about->image ? resolve(GetFileUrlAction::class)->execute($about->image): null;
        $technologies = $about->skill->technologies;

        // Act
        $response = $this->get(route('about.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/About')
                                    ->where('about.data.image_url', $imageUrl)
                                    ->where('about.data.text', $about->text)
                                    ->where('about.data.technologies.0.name', $technologies->first()->name)
        );
    });

    it('edits about', function () {
        // Arrange
        $technologies = Technology::whereIn('name', ['PHP', 'Java'])->get();

        $params = [
            'text' => "This is some about text",
            'technologies' => [$technologies->first()->id, $technologies->last()->id]
        ];

        // Act
        $response = $this->put(route('about.edit', $params));

        $about = About::where('user_id', UserEnum::ADMIN)->firstOrFail();

        // Assert
        $response->assertRedirect(route('about.view', ['about' => $about]))
                ->assertInertiaFlash('message', 'About has been updated')
                ->assertInertiaFlash('type', FlashTypeEnum::SUCCESS);
    });
});
