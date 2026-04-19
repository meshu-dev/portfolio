<?php

namespace App\Actions\Cloudflare;

use App\Exceptions\TurnstileTokenException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ValidateTrunstilesTokenAction
{
    public function execute(string $token): true
    {
        $turnstileVerifyUrl = config('services.cloudflare.turnstile.verify_url');
        $turnstileSecretKey = config('services.cloudflare.turnstile.secret_key');

        $response = Http::acceptJson()->post(
            $turnstileVerifyUrl,
            [
                'secret'   => $turnstileSecretKey,
                'response' => $token,
                'remoteip' => null,
            ]
        );

        $result = $response->json();

        Log::info('ValidateTrunstilesTokenAction', ['result' => $result]);

        throw_unless(
            $result['success'],
            TurnstileTokenException::class,
            $response['error-codes'][0]
        );

        return true;
    }
}
