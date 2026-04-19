<?php

namespace App\Actions\Contact;

use App\Enums\TypeEnum;
use App\Factories\TokenValidatorFactory;
use App\Jobs\SendContactEmailJob;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SendMessageAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(TypeEnum $type, array $params): bool
    {
        Log::info('Contact form request', ['params' => $params]);

        $isValid = false;

        if (!App::environment('local')) {
            $validator = resolve(TokenValidatorFactory::class)->make($type);
            $isValid   = $validator->execute($params['token']);
        }

        unset($params['token']);
        SendContactEmailJob::dispatchIf($isValid, $params);

        return $isValid;
    }
}
