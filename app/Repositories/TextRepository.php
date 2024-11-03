<?php

namespace App\Repositories;

use App\Models\Text;
use Illuminate\Support\Collection;

class TextRepository
{
    /**
     * @return Collection<int, Text>
     */
    public function getAll(): Collection
    {
        return Text::get();
    }

    /**
     * @param array<int, string> $names
     * @return Collection<string, string>
     */
    public function getByNames(array $names): Collection
    {
        return Text::whereIn("name", $names)
            ->get()
            ->mapWithKeys(fn ($item) => [$item->name => $item->value]);
    }
}
