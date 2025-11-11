<?php

namespace App\Actions\File;

use App\Exceptions\FileNotUploadedException;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadFileAction
{
    /**
     * @return string
     */
    public function execute(string $filename): string
    {
        throw_unless(
            Storage::disk('local')->exists("files/$filename"),
            FileNotUploadedException::class,
            'Local file does not exist'
        );

        $file = new File(storage_path('app/files') . '/' . $filename);

        $fileDriver = config('filesystems.default');
        $fileUrl    = Storage::disk($fileDriver)->putFileAs(
            'site',
            $file,
            $filename,
            'public'
        );

        throw_unless(
            $fileUrl,
            FileNotUploadedException::class,
            'File could not be uploaded to ' . $fileDriver
        );

        return $fileUrl;
    }
}
