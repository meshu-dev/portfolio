<?php

use App\Actions\File\MoveFileAction;
use App\Actions\File\UploadFileAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery\MockInterface;

describe('Commands\CreateCvPdf tests', function () {
    it('generates PDF', function () {
        // Arrange
        Storage::fake();

        $filename = 'cv.pdf';
        $cvFilePath  = storage_path('app/files') . '/' . $filename;

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

        $fileUrl = 'http://s3bucket.amazon.com/cv.pdf';

        $moveFileAction = mock(MoveFileAction::class, function (MockInterface $mock) use ($fileUrl) {
            $mock->shouldReceive('execute')
                ->once()
                ->with('cv.pdf')
                ->andReturn($fileUrl);
        });

        $this->app->bind(MoveFileAction::class, fn () => $moveFileAction);

        // Act
        $this->artisan('app:create-cv-pdf')->assertExitCode(0);

        // Assert
        $this->assertDatabaseHas('files', [
            'name' => $filename,
            'url' => $fileUrl,
        ]);
    });
});
