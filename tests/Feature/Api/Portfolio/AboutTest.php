<?php

describe('API - Portfolio About', function () {
    it('returns CV data', function () {
        $response = $this->get(route('portfolio.about'));

        expect($response->status())->toEqual(200);
        expect($response->json())->toBeArray();
        expect($response->json())->toHaveKey('data');
    });
});
