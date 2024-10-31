<?php

describe('API - CV', function () {
    it('returns CV data', function () {
        $response = $this->get(route('cv'));

        expect($response->status())
            ->toEqual(200);

        expect($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    });
});
