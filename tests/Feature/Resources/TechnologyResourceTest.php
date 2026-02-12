<?php

use App\Models\Technology;
use App\Http\Resources\TechnologyResource;

describe('Resource - TechnologyResourceTest', function () {
    it('checks resource', function () {
        $technologies = Technology::factory()->count(2)->create();
        $technologies = TechnologyResource::collection($technologies)->resolve();

        expect($technologies)
            ->toBeArray()
            ->toHaveCount(2);

        expect($technologies[0])
            ->toHaveKeys(['name']);
    });
});
