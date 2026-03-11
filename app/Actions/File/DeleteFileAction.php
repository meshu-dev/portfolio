<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DeleteFileAction
{
    /**
     * @return FileModel
     */
    public function execute(File $file): bool
    {
        Storage::delete($file->url);

        return $file->delete();
    }
}
