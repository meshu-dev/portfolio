<?php

namespace App\Console\Commands;

use App\Actions\Cv\GetCvAction;
use Illuminate\Console\Command;
use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;

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
        $pageMarginX = 30;
        $pageMarginY = 25;
        $browsershotChromePath = config('services.browsershot.chrome_path');
        $browsershotTempPath = config('services.browsershot.chrome_path');

        $browsershotFtn = function ($browsershot) use ($browsershotChromePath, $browsershotTempPath) {
            return $browsershot->noSandbox()
                               ->setChromePath($browsershotChromePath)
                               ->setCustomTempPath($browsershotTempPath);
        };

        Pdf::view('pdf-view', $viewParams)
            ->withBrowsershot($browsershotFtn)
            ->margins($pageMarginY, $pageMarginX, $pageMarginY, $pageMarginX)
            ->format(Format::A4)
            ->save($cvFilePath);
    }
}
