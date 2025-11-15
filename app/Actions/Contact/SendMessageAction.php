<?php

namespace App\Actions\Contact;

use App\Exceptions\GoogleTokenException;
use App\Jobs\SendContactEmailJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendMessageAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): bool
    {
        Log::info('Contact form request', ['params' => $params]);

        if (!App::environment('local')) {
            $this->authenticateToken($params['token']);
        }

        SendContactEmailJob::dispatch($params);

        return true;
    }

    protected function authenticateToken(string $token): void
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
