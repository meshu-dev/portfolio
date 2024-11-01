<?php

namespace App\Repositories;

use App\Models\Text;
use Illuminate\Support\Collection;

class TextRepository
{
    public function getAll(): Collection
    {
        return Text::get();
    }

    public function getByNames(array $names): Collection
    {
        return Text::whereIn("name", $names)
            ->get()
            ->mapWithKeys(fn ($item) => [$item->name => $item->value]);
    }
}
