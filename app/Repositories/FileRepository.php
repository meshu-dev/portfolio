<?php

namespace App\Repositories;

use App\Models\File;
use Illuminate\Support\Collection;

class FileRepository
{
    public function getAll(): Collection
    {
        return File::get();
    }

    public function getByName(string $name): File|null
    {
        return File::where('name', $name)->first();
    }
}
