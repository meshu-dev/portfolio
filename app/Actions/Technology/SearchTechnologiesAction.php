<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;

class SearchTechnologiesAction
{
    /**
     * @param int $userId
     * @param string $search
     * @return Collection<int, Technology>
     */
    public function execute(int $userId, string $search): Collection
    {
        return Technology::where('user_id', $userId)
                         ->orderBy('name')
                         ->whereLike('name', "$search%")
                         ->get();
    }
}
