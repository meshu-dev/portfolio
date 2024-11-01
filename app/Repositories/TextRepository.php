<?php

namespace App\Repositories;

use App\Models\Text;

class TextRepository
{
    public function getAll()
    {
        return Text::get();
    }

    public function getByNames(array $names)
    {
        return Text::whereIn("name", $names)
            ->get()
            ->mapWithKeys(fn ($item) => [$item->name => $item->value]);
    }
}
