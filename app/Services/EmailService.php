<?php

namespace App\Services;

use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    public function sendContactEmail(array $params)
    {
        Mail::to(config('mail.to.address'))->send(
            new ContactEmail($params)
        );
    }
}
