<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\Enums\UserEnum;

describe('API - Portfolio Projects', function () {
    it('returns CV data', function () {
        Sanctum::actingAs(
            User::find(UserEnum::MESH)
        );

        $response = $this->get(route('portfolio.projects'));

        expect($response->status())->toEqual(200);
        expect($response->json())->toBeArray();
        expect($response->json())->toHaveKey('data');
    });
});
