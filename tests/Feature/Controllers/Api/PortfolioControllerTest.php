<?php

use App\Enums\UserEnum;
use App\Models\User;
use Laravel\Sanctum\Sanctum;

describe('Api\PortfolioController tests', function () {
    beforeEach(function () {
        Sanctum::actingAs(
            User::find(UserEnum::ADMIN)
        );
    });

    it('gets portfolio data', function () {
        $response = $this->get(route('portfolio'));

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });
});
