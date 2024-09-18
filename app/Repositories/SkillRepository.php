<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository
{
    public function getAll()
    {
        return Skill::with('technologies')->get();
    }

    public function getByNames(array $names)
    {
        return Skill::with(['technologies', 'technologies.badge'])
            ->whereIn('name', $names)
            ->get();
    }
}
