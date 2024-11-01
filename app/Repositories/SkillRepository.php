<?php

namespace App\Repositories;

use App\Models\Skill;
use Illuminate\Support\Collection;

class SkillRepository
{
    public function getAll(): Collection
    {
        return Skill::with('technologies')->get();
    }

    public function getByNames(array $names): Collection
    {
        return Skill::with(['technologies', 'technologies.badge'])
            ->whereIn('name', $names)
            ->get();
    }
}
