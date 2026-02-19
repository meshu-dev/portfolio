<?php

namespace App\Actions\Cv\Skill;

use App\Models\Skill;
use Illuminate\Support\Collection;

class UpdateSkillTechnologiesAction
{
    /**
     * @param Collection<int, array> $skillTechnologies
     */
    public function execute(Collection $skillTechnologies): void
    {
        foreach ($skillTechnologies as $skillId => $technologies) {
            Skill::findOrFail($skillId)->technologies()->sync($technologies);
        }
    }
}
