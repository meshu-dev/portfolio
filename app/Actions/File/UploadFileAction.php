<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadFileAction
{
    /**
     * @return FileModel
     */
    public function execute(UploadedFile $file): File
    {
        $originalFilename = $file->getClientOriginalName();
        $filename = Str::uuid() . '.' . $file->extension();

        $path = $file->storeAs('images', $filename);

        return File::create([
            'name' => $originalFilename,
            'url'  => $path,
        ]);
    }
}
