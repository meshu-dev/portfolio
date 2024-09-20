<?php

use App\Models\File;
use App\Http\Resources\FileResource;

describe('Resource - FileResource', function () {
    it('checks resource', function () {
        $files = File::factory()->count(2)->create();
        $files = FileResource::collection($files)->resolve();

        expect($files)
            ->toBeArray()
            ->toHaveCount(2);

        expect($files[0])
            ->toHaveKeys(['name', 'url']);
    });
});
