<?php

namespace App\Console\Commands;

use App\Actions\Cv\CreateCvPdfAction;
use App\Enums\UserEnum;
use Illuminate\Console\Command;

class CreateCvPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-cv-pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a CV document in PDF format';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        resolve(CreateCvPdfAction::class)->execute(UserEnum::ADMIN->value);
    }
}
