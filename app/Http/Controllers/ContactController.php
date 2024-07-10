<?php

namespace App\Http\Controllers;

use App\Jobs\SendContactEmailJob;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    /**
     * Use contact form details to send e-mail.
     */
    public function sendMessage(ContactRequest $contactRequest)
    {
        $params = $contactRequest->all();
        SendContactEmailJob::dispatch($params);

        return response()->json([]);
    }
}
