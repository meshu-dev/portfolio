<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Support\Collection;

class SkillRepository
{
    /**
     * @param array<int, string> $names
     * @return Collection<int, Skill>
     */
    public function getByNames(array $names): Collection
    {
        return Skill::with(['technologies', 'technologies.badge'])
            ->whereIn('name', $names)
            ->get();
    }
}
