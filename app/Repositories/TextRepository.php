<?php

namespace App\Repositories;

use App\Models\Text;
use Illuminate\Support\Collection;

class TextRepository
{
    /**
     * @param int $userId
     * @param array<int, string> $names
     * @return Collection<string, string>
     */
    public function getByNames(int $userId, array $names): Collection
    {
        return Text::where('user_id', $userId)
                   ->whereIn("name", $names)
                   ->get()
                   ->mapWithKeys(fn ($item) => [$item->name => $item->value]);
    }

    /**
     * @param int $userId
     * @param string $name
     * @param mixed $value
     * @return Collection<string, string>
     */
    public function updateByName(
        int $userId,
        string $name,
        mixed $value
    ): bool {
        return Text::where('user_id', $userId)
                   ->where('name', $name)
                   ->update(['value' => $value]);
    }
}
