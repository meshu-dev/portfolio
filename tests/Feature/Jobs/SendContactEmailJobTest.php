<?php

describe('Job - Send Contact Email', function () {
    it('returns CV data', function () {
        $response = $this->get('/cv');

        expect($response->status())
            ->toEqual(200);

        expect($response->json())
            ->toBeArray()
            ->toHaveKey('data');
    })->skip();
});
