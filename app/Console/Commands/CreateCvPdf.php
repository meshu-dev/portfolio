<?php

namespace App\Console\Commands;

use App\Actions\Cv\CreateCvPdfAction;
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

    public function __construct(protected CreateCvPdfAction $createCvPdfAction)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->createCvPdfAction->execute();
    }
}
