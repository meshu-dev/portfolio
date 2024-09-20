<?php

use Barryvdh\DomPDF\Facade\Pdf;

describe('Command - Create CV PDF', function () {
    it('generates PDF', function () {
        $cvFilePath  = storage_path('app/files') . '/cv.pdf';

        $pdfMock = Pdf::shouldReceive('loadView')
            ->once()
            ->andReturnSelf()
            ->getMock();

        $pdfMock->shouldReceive('setPaper')
            ->once()
            ->withArgs(['A4', 'portrait']);

        $pdfMock->shouldReceive('save')
            ->once()
            ->with($cvFilePath);

        $this->artisan('app:create-cv-pdf')->assertExitCode(0);
    });
});
