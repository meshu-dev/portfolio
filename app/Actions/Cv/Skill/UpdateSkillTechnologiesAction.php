<?php

namespace App\Actions\Cv\Skill;

use App\Models\Skill;

class UpdateSkillTechnologiesAction
{
    /**
     * @param array<int, array<string, array<int, string>|string>> $skillTechnologies
     */
    public function execute(array $skillTechnologies): void
    {
        foreach ($skillTechnologies as $skillData) {
            $skill = Skill::findOrFail($skillData['id']);

            /** @var Skill $skill */
            $skill->technologies()->sync($skillData['technologies']);
        }
    }
}
