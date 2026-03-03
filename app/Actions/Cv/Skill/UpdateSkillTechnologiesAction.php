<?php

namespace App\Actions\Cv\Skill;

use App\Models\Skill;

class UpdateSkillTechnologiesAction
{
    /**
     * @param array<string, mixed> $skillTechnologies
     */
    public function execute(array $skillTechnologies): void
    {
        foreach ($skillTechnologies as $skillData) {
            Skill::findOrFail($skillData['id'])->technologies()->sync($skillData['technologies']);
        }
    }
}
