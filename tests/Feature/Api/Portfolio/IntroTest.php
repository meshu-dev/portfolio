<?php

describe('API - Portfolio Intro', function () {
    it('returns project intro data', function () {
        $response = $this->get('/portfolio/intro');

        expect($response->status())->toEqual(200);
        expect($response->json())->toBeArray();
        expect($response->json())->toHaveKey('data');
    });
});
