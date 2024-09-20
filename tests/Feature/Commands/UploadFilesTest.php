<?php

use Illuminate\Support\Facades\Storage;

describe('Command - Upload Files', function () {
    it('uploads files', function () {
        $invalidFiles = [
            'files/.DS_Store',
            'files/.gitignore',
        ];

        $validFiles = [
            'files/cv.pdf',
            'files/about.png',
            'files/cv.png'
        ];
        $validFileCount = count($validFiles);

        $files = array_merge($invalidFiles, $validFiles);

        Storage::shouldReceive('files')
            ->once()
            ->andReturn($files);

        Storage::shouldReceive('disk')->times($validFileCount)->andReturnSelf();
        Storage::shouldReceive('putFileAs')->times($validFileCount);

        $this->artisan('app:upload-files')->assertExitCode(0);
    });
});
