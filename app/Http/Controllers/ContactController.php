<?php

namespace App\Http\Controllers;

use App\Actions\Contact\SendMessageAction;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Use contact form details to send e-mail.
     */
    public function sendMessage(ContactRequest $contactRequest, SendMessageAction $sendMessageAction)
    {
        $params = $contactRequest->all();
        $result = $sendMessageAction->execute($params);

        return response()->json(['success' => $result]);
    }
}
