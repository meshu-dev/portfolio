<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class DeleteFileAction
{
    /**
     * @return bool|null
     */
    public function execute(File $file): bool|null
    {
        Storage::delete($file->url);

        return $file->delete();
    }
}
