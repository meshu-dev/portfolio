<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Support\Collection;

class SkillRepository
{
    /**
     * @param int $userId
     * @param array<int, string> $names
     * @return Collection<int, Skill>
     */
    public function getByNames(int $userId, array $names): Collection
    {
        return Skill::with(['technologies'])
            ->where('user_id', $userId)
            ->whereIn('name', $names)
            ->get();
    }
}
