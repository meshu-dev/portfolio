<?php

describe('API - Login', function () {
    beforeEach(function () {
        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    });

    it('authenticates login details and returns a valid token', function () {
        $params = [
            'email'    => config('users.main.email'),
            'password' => config('users.main.password'),
        ];

        $response = $this->withHeaders($this->headers)
                         ->post(route('api.login', $params));

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('data')
            ->and($response->json()['data'])
            ->toHaveKey('token')
            ->and($response->json()['data']['token'])
            ->toBeString();
    });

    it('fails with incorrect login details', function () {
        $params = [
            'email'    => 'fake@gmail.com',
            'password' => '12345678',
        ];

        $response = $this->withHeaders($this->headers)
                         ->post(route('api.login', $params));

        expect($response->status())
            ->toEqual(401)
            ->and($response->json())
            ->toBeArray()
            ->toHaveKey('error')
            ->and($response->json()['error'])
            ->toEqual('Login details are invalid');
    });
});
