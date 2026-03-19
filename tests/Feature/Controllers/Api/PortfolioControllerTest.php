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

    it('gets portfolio intro data', function () {
        $response = $this->get(route('portfolio.intro'));

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });

    it('gets porfolio about data', function () {
        $response = $this->get(route('portfolio.about'));

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });

    it('gets porfolio project data', function () {
        $response = $this->get(route('portfolio.projects'));

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });
});
