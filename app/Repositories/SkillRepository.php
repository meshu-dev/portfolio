<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Support\Collection;

class SkillRepository
{
    /**
     * @return Collection<int, Skill>
     */
    public function getAll(): Collection
    {
        return Skill::with('technologies')->get();
    }

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
