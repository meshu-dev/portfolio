<?php

namespace App\Repositories;

use App\Models\File;

class FileRepository
{
    public function getAll()
    {
        return File::get();
    }

    public function getByName(string $name)
    {
        return File::where('name', $name)->first();
    }
}
