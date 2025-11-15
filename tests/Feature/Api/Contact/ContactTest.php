<?php

describe('API - Contact', function () {
    it('adds contact message to queue', function () {
        Queue::fake();
        Http::fake(fn () => Http::response(['success' => true], 200, ['Headers']));

        $params = [
            'name'    => 'Mesh',
            'email'   => 'mesh@gmail.com',
            'message' => 'This is a test message',
            'token'   => 'uipoV9loh9ohJ!o0mepae@b2ooL5pooviu@Jah6aid3qua0euv'
        ];
        $response = $this->post(route('contact'), $params);

        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->success->toBeTrue()
            ->message->toBe('Message sent, expect a response shortly');
    });

    it('checks bad token', function ($message, $errorCode) {
        Queue::fake();

        $params = [
            'success' => false,
            'error-codes' => $errorCode != 'no-code' ? [$errorCode] : null
        ];
        $params = json_encode($params);

        Http::fake(fn () => Http::response($params, 200, ['Headers']));

        $params = [
            'name'    => 'Mesh',
            'email'   => 'mesh@gmail.com',
            'message' => 'This is a test message',
            'token'   => 'uipoV9loh9ohJ!o0mepae@b2ooL5pooviu@Jah6aid3qua0euv'
        ];
        $response = $this->post(route('contact'), $params);

        expect($response->status())
            ->toEqual(500)
            ->and($response->json())
            ->message
            ->toBe($message);
    })->with([
        'invalid input' => [
            'Submitted token is invalid',
            'invalid-input-response',
        ],
        'not verified' => [
            'Could not connect to the verify site',
            'browser-error',
        ],
        'failed' => [
            'Verification for token has failed',
            'default',
        ],
        'no code' => [
            'Verification for token has failed',
            'no-code',
        ],
    ]);
});
