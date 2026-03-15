<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class GetFileUrlAction
{
    /**
     * @return string
     */
    public function execute(File $file): string
    {
        if (App::environment('local')) {
            return $file->url;
        }
         //Storage::temporaryUrl($this->image->url, now()->addMinutes(60)) : null,
        return Storage::url($file->url);
    }
}
