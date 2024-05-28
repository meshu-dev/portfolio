<?php

namespace App\Console\Commands;

use App\Services\CvService;
use Illuminate\Console\Command;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

class GenerateCvPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-cv-pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates a CV document in PDF format';

    public function __construct(protected CvService $cvService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $viewParams  = [...$this->cvService->get()];
        $cvFilePath  = resource_path() . '/pdf/cv.pdf';
        $pageMarginX = 30;
        $pageMarginY = 25;

        Pdf::view('pdf-view', $viewParams)
            ->margins($pageMarginY, $pageMarginX, $pageMarginY, $pageMarginX)
            ->format(Format::A4)
            ->save($cvFilePath);
    }
}
