<?php

use App\Actions\File\UploadFileAction;
use Barryvdh\DomPDF\Facade\Pdf;
use Mockery\MockInterface;

describe('Command - Create CV PDF', function () {
    it('generates PDF', function () {
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

        $uploadFileAction = mock(UploadFileAction::class, function (MockInterface $mock) use ($fileUrl) {
            $mock->shouldReceive('execute')
                ->once()
                ->with('cv.pdf')
                ->andReturn($fileUrl);
        });

        $this->app->bind(UploadFileAction::class, fn () => $uploadFileAction);

        $this->artisan('app:create-cv-pdf')->assertExitCode(0);
        
        $this->assertDatabaseHas('files', [
            'name' => $filename,
            'url' => $fileUrl,
        ]);
    });
});
