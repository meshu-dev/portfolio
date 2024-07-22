<?php

namespace App\Actions\Contact;

use App\Exceptions\GoogleTokenException;
use App\Jobs\SendContactEmailJob;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class SendMessageAction
{
    public function execute(array $params): bool
    {
        $token           = $params['token'];
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

        SendContactEmailJob::dispatch($params);

        return true;
    }

    public function getErrorCode(array $response): string
    {
        if ($response['error-codes']) {
            $code = $response['error-codes'][0];
        } else {
            $code = 'default';
        }
        return $code;
    }
}