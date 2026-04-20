<?php

use App\Actions\Cloudflare\ValidateTrunstilesTokenAction;
use App\Enums\TurnstileErrorCodeEnum;
use App\Exceptions\TurnstileTokenException;
use Mockery\MockInterface;

describe('Api\ContactController tests', function () {
    beforeEach(function () {
        $this->headers = [
            'Referer' => 'https://meshpro.io',
        ];

        $this->contactParams = [
            'name'    => 'Mesh',
            'email'   => 'mesh@gmail.com',
            'message' => 'This is a test message',
            'token'   => 'uipoV9loh9ohJ!o0mepae@b2ooL5pooviu@Jah6aid3qua0euv'
        ];
    });

    it('adds contact message to queue', function () {
        // Arrange
        Queue::fake();
        Http::fake(fn () => Http::response(['success' => true], 200, ['Headers']));

        $validateTokenAction = mock(ValidateTrunstilesTokenAction::class, function (MockInterface $mock) {
            $mock->shouldReceive('execute')
                ->once()
                ->with($this->contactParams['token'])
                ->andReturn(true);
        });

        $this->app->bind(ValidateTrunstilesTokenAction::class, fn () => $validateTokenAction);

        // Act
        $response = $this->withHeaders($this->headers)
                         ->post(route('contact'), $this->contactParams);

        // Assert
        expect($response->status())
            ->toEqual(200)
            ->and($response->json())
            ->success->toBeTrue()
            ->message->toBe('Message sent, expect a response shortly');
    });

    it('checks submitted token is invalid', function () {
        // Arrange
        Queue::fake();

        $message   = TurnstileErrorCodeEnum::INVALID_RESPONSE->message();
        $errorCode = TurnstileErrorCodeEnum::INVALID_RESPONSE;

        Http::fake(fn () => Http::response(getValidateTokenParams($errorCode), 500, ['Headers']));

        // Act
        $response = $this->withHeaders($this->headers)
                         ->post(route('contact'), $this->contactParams);

        // Assert
        expect($response->status())
            ->toEqual(500)
            ->and($response->json())
            ->message
            ->toBe($message);
    })->throws(TurnstileTokenException::class, TurnstileErrorCodeEnum::INVALID_RESPONSE->message());
});

function getValidateTokenParams(TurnstileErrorCodeEnum $errorCode)
{
    $params = [
        'success' => false,
        'error-codes' => [$errorCode]
    ];
    return json_encode($params);
}
