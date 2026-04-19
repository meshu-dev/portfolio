<?php

namespace App\Actions\Google;

use App\Exceptions\GoogleTokenException;
use Illuminate\Support\Facades\Http;

class ValidateReCaptchaTokenAction
{
    public function execute(string $token): true
    {
        $googleVerifyUrl = config('services.google.recaptcha.verify_url');
        $googleSecretKey = config('services.google.recaptcha.secret_key');

        $response = Http::asForm()->post(
            $googleVerifyUrl,
            [
                'secret'   => $googleSecretKey,
                'response' => $token
            ]
        );

        $response = json_decode($response->body(), true);

        throw_unless(
            $response['success'],
            GoogleTokenException::class,
            $this->getErrorCode($response)
        );

        return true;
    }

    /**
     * @param array<string, mixed> $response
     */
    public function getErrorCode(array $response): string
    {
        if (!empty($response['error-codes'])) {
            $code = $response['error-codes'][0];
        } else {
            $code = 'default';
        }
        return $code;
    }
}
