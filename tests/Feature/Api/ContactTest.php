<?php

use App\Exceptions\GoogleTokenException;

describe('API - Contact', function () {
    beforeEach(function () {
        $this->contactParams = [
            'name'    => 'Mesh',
            'email'   => 'mesh@gmail.com',
            'message' => 'This is a test message',
            'token'   => 'uipoV9loh9ohJ!o0mepae@b2ooL5pooviu@Jah6aid3qua0euv'
        ];
    });

    it('adds contact message to queue', function () {
        Queue::fake();
        Http::fake(fn () => Http::response(['success' => true], 200, ['Headers']));

        $response = $this->post(route('contact'), $this->contactParams);

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->success->toBeTrue()
            ->message->toBe('Message sent, expect a response shortly');
    });

    it('checks submitted token is invalid', function () {
        Queue::fake();

        $message   = 'Submitted token is invalid';
        $errorCode = 'invalid-input-response';

        Http::fake(fn () => Http::response(getGoogleParams($errorCode), 200, ['Headers']));

        $response = $this->post(route('contact'), $this->contactParams);

        expect($response->status())
            ->toEqual(500)
            ->and($response->json())
            ->message
            ->toBe($message);
    })->throws(GoogleTokenException::class, 'Submitted token is invalid');

    it('checks submitted token is not verified', function () {
        Queue::fake();

        $message   = 'Could not connect to the verify site';
        $errorCode = 'browser-error';

        Http::fake(fn () => Http::response(getGoogleParams($errorCode), 200, ['Headers']));

        $response = $this->post(route('contact'), $this->contactParams);

        expect($response->status())
            ->toEqual(500)
            ->and($response->json())
            ->message
            ->toBe($message);
    })->throws(GoogleTokenException::class, 'Could not connect to the verify site');

    it('checks submitted token has failed', function () {
        Queue::fake();

        $message   = 'Verification for token has failed';
        $errorCode = 'default';

        Http::fake(fn () => Http::response(getGoogleParams($errorCode), 200, ['Headers']));

        $response = $this->post(route('contact'), $this->contactParams);

        expect($response->status())
            ->toEqual(500)
            ->and($response->json())
            ->message
            ->toBe($message);
    })->throws(GoogleTokenException::class, 'Verification for token has failed');
});

function getGoogleParams(string $errorCode)
{
    $params = [
        'success' => false,
        'error-codes' => $errorCode != 'no-code' ? [$errorCode] : null
    ];
    return json_encode($params);
}
