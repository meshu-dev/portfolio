<?php

use App\Enums\UserEnum;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

describe('Api\CvController tests', function () {
    it('returns CV data', function () {
        Sanctum::actingAs(
            User::find(UserEnum::ADMIN)
        );

        $response = $this->get(route('cv'));

        expect($response->status())
            ->toEqual(200);

        expect($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });
});
