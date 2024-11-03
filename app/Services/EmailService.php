<?php

namespace App\Services;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @param array<string, mixed> $params
     */
    public function sendContactEmail(array $params): void
    {
        Mail::to(config('mail.to.address'))->send(
            new ContactEmail($params)
        );
    }
}
