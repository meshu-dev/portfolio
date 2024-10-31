<?php

describe('API - Portfolio Projects', function () {
    it('returns CV data', function () {
        $response = $this->get(route('portfolio.projects'));

        expect($response->status())->toEqual(200);
        expect($response->json())->toBeArray();
        expect($response->json())->toHaveKey('data');
    });
});
