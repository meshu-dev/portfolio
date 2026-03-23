<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadFileAction
{
    /**
     * @return File
     */
    public function execute(UploadedFile $file): File
    {
        $originalName = $file->getClientOriginalName();

        $fileDriver = config('filesystems.default');

        $filePath = match ($fileDriver) {
            'local' => Storage::putFile('images', $file),
            's3'    => Storage::putFileAs('site', $file, Str::uuid(), 'public'),
        };

        return File::create([
            'user_id' => Auth::id(),
            'name'    => $originalName,
            'url'     => $filePath
        ]);
    }
}
