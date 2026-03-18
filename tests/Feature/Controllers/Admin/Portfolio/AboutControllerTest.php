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
        $resource = [
            'image_url'    => $about->image ? resolve(GetFileUrlAction::class)->execute($about->image): null,
            'text'         => $about->text,
            'technologies' => $about->skill->technologies->toArray()
        ];

        // Act
        $response = $this->get(route('about.view'));

        // Assert
        $response->assertInertia(
            fn (Assert $page) => $page->component('Portfolio/About')
                                    ->where('about', ['data' => $resource])
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
