<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpsertFileAction
{
    /**
     * @return FileModel
     */
    public function execute(UploadedFile $file): File
    {
        $originalName = $file->getClientOriginalName();
        $filePath     = Storage::putFile('images', $file);

        return File::create([
            'user_id' => Auth::id(),
            'name'    => $originalName,
            'url'     => $filePath
        ]);
    }
}
