<?php

namespace App\Actions\File;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class UploadFileAction
{
    /**
     * @return string|false
     */
    public function execute(string $filename): string|false
    {
        if (Storage::disk('local')->exists("files/$filename")) {
            $file = new File(storage_path('app/files') . '/' . $filename);

            return Storage::disk('s3')->putFileAs(
                '',
                $file,
                "site/$filename",
                'public'
            );
        }
        return false;
    }
}
