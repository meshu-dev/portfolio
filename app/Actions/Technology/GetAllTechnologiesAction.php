<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;

class GetAllTechnologiesAction
{
    /**
     * @param int $userId
     * @return Collection<int, Technology>
     */
    public function execute(int $userId): Collection
    {
        return Technology::where('user_id', $userId)
                         ->orderBy('name')
                         ->get();
    }
}
