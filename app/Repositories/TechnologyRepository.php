<?php

namespace App\Repositories;

use App\Enums\SkillEnum;
use App\Models\{Skill, Technology};
use Illuminate\Support\Collection;

class TechnologyRepository
{
    /**
     * @param int $userId
     * @param SkillEnum $skill
     * @return Collection<int, Technology>
     */
    public function getBySkill(int $userId, SkillEnum $skill): Collection
    {
        return Skill::with(['technologies'])
            ->where('user_id', $userId)
            ->where('name', $skill->value)
            ->firstOrFail()
            ->technologies;
    }
}
