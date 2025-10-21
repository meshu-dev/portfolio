<?php

namespace App\Actions\File;

use App\Models\File;

class CreateFileAction
{
    /**
     * @return File
     */
    public function execute(string $filename): File
    {
        $fileUrl = resolve(UploadFileAction::class)->execute($filename);

        return File::create([
            'name' => $filename,
            'url'  => $fileUrl
        ]);
    }
}
