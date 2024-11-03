<?php

namespace App\Services;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * @param array<int, mixed> $params
     */
    public function sendContactEmail(array $params): void
    {
        Mail::to(config('mail.to.address'))->send(
            new ContactEmail($params)
        );
    }
}
