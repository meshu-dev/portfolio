<?php

namespace App\Console\Commands;

use App\Actions\Cv\GetCvAction;
use Illuminate\Console\Command;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function __construct(protected GetCvAction $getCvAction)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewParams  = [...$this->getCvAction->execute()];
        $cvFilePath  = storage_path('app/files') . '/cv.pdf';

        $pdf = Pdf::loadView('cv-pdf', $viewParams);
        $pdf->setPaper('A4', 'portrait');
        $pdf->save($cvFilePath);
    }
}
