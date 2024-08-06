<?php

namespace App\Http\Controllers;

use App\Actions\Contact\SendMessageAction;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Log;
use Exception;

class ContactController extends Controller
{
    /**
     * Use contact form details to send e-mail.
     */
    public function sendMessage(ContactRequest $contactRequest, SendMessageAction $sendMessageAction)
    {
        try {
            $params = $contactRequest->all();
            $result = $sendMessageAction->execute($params);
            $message = 'Message sent, expect a response shortly';
            $code = 200;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            $result = false;
            $message = 'Contact message couldn\'t be sent. Please try again later';
            $code = 500;
        }

        return response()->json(
            [
                'success' => $result,
                'message' => $message
            ],
            $code
        );
    }
}
