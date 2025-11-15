<?php

use App\Actions\Contact\SendEmailAction;
use App\Jobs\SendContactEmailJob;
use App\Mail\ContactEmail;
use App\Services\EmailService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Address;

describe('Job - Send Contact Email', function () {
    it('returns CV data', function () {
        Mail::fake();

        $params = [
            'name'    => 'Mesh',
            'email'   => 'mesh@gmail.com',
            'message' => 'This is a test message'
        ];

        $sendEmailAction = resolve(SendEmailAction::class);

        resolve(SendContactEmailJob::class, ['params' => $params])->handle($sendEmailAction);

        $contactEmail = new ContactEmail($params);
        $contactEmail->assertFrom(new Address(config('mail.from.address'), config('mail.from.name')));

        Mail::assertSent(ContactEmail::class);
    });
});
