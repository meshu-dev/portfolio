<?php

namespace App\Actions\Cv;

use App\Actions\File\CreateFileAction;
use Barryvdh\DomPDF\Facade\Pdf;

class CreateCvPdfAction
{
    protected const string FILENAME = 'cv.pdf';

    public function __construct(
        protected GetCvAction $getCvAction
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): void
    {
        // Get CV Data
        $viewParams  = [...$this->getCvAction->execute()];

        // Generate PDF
        $cvFilePath  = storage_path('app/files') . '/' . self::FILENAME;

        $pdf = Pdf::loadView('cv-pdf', $viewParams);
        $pdf->setPaper('A4', 'portrait');
        $pdf->save($cvFilePath);

        // Copy local CV.pdf to S3 and create file DB data
        resolve(CreateFileAction::class)->execute(self::FILENAME);
    }
}
