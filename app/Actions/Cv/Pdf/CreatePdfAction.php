<?php

namespace App\Actions\Cv\Pdf;

use App\Actions\File\MoveFileAction;
use App\Models\File;
use Barryvdh\DomPDF\Facade\Pdf;

class CreatePdfAction
{
    protected const string FILENAME = 'cv.pdf';

    public function __construct(
        protected GetCvDataForPdfAction $getCvPdfAction
    ) {
    }

    /**
     * @return void
     */
    public function execute(int $userId): void
    {
        // Get CV Data
        $viewParams  = [...$this->getCvPdfAction->execute($userId)];

        // Generate PDF
        $cvFilePath  = storage_path('app/private') . '/' . self::FILENAME;

        $pdf = Pdf::loadView('pdf/cv', $viewParams);
        $pdf->setPaper('A4', 'portrait');
        $pdf->save($cvFilePath);

        // Transfer local CV.pdf to S3
        $fileUrl = resolve(MoveFileAction::class)->execute(self::FILENAME);

        // Create file DB data
        File::updateOrCreate(
            ['name' => self::FILENAME],
            ['url'  => $fileUrl]
        );
    }
}
