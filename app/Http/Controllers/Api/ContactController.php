<?php

namespace App\Http\Controllers\Api;

use App\Actions\Contact\SendMessageAction;
use App\Actions\Type\GetTypeByUrlAction;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Use contact form details to send e-mail.
     */
    public function sendMessage(ContactRequest $contactRequest, SendMessageAction $sendMessageAction): JsonResponse
    {
        Log::error('Request', ['con' => $contactRequest->host(), 'ref' => $contactRequest->headers->get('referer')]);
        //dd('$contactRequest', $contactRequest->host());

        try {
            $referer = $contactRequest->headers->get('referer');

            $type = resolve(GetTypeByUrlAction::class)->execute($referer);
            $type = TypeEnum::from($type->id);

            $params  = $contactRequest->all();
            $result  = $sendMessageAction->execute($type, $params);

            $message = 'Message sent, expect a response shortly';
        } catch (Exception $e) {
            Log::error($e->getMessage());
            throw $e;
        }

        return response()->json([
            'success' => $result,
            'message' => $message
        ]);
    }
}
