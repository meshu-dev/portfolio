<?php

namespace App\Console\Commands;

use App\Services\CvService;
use Illuminate\Console\Command;
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
    protected $description = 'Command description';

    public function __construct(protected CvService $cvService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cvFilePath = resource_path() . '/pdf/cv.pdf';

        Pdf::view('pdf-view', [...$this->cvService->get()])
            ->format('a4')
            ->save($cvFilePath);
    }
}
