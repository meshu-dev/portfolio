<?php

namespace App\Actions\Contact;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): void
    {
        Mail::to(config('mail.to.address'))->send(
            new ContactEmail($params)
        );
    }
}
