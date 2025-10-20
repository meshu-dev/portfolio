<?php

namespace App\Actions\Cv;

use Barryvdh\DomPDF\Facade\Pdf;

class CreateCvPdfAction
{
    public function __construct(
        protected GetCvAction $getCvAction
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): void
    {
        $viewParams  = [...$this->getCvAction->execute()];
        $cvFilePath  = storage_path('app/files') . '/cv.pdf';

        $pdf = Pdf::loadView('cv-pdf', $viewParams);
        $pdf->setPaper('A4', 'portrait');
        $pdf->save($cvFilePath);
    }
}
