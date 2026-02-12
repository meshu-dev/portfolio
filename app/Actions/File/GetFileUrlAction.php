<?php

namespace App\Actions\File;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class GetFileUrlAction
{
    public function __construct(protected string $name)
    {
    }

    /**
     * @return string
     */
    public function execute(): string
    {
        $file = File::where('name', $this->name)->firstOrFail();

        return Storage::url($file->url);
    }
}
