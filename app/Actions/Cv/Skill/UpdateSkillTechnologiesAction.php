<?php

namespace App\Actions\Cv\Skill;

use App\Models\Skill;
use Illuminate\Support\Collection;

class UpdateSkillTechnologiesAction
{
    /**
     * @param array $skillTechnologies
     */
    public function execute(array $skillTechnologies): void
    {
        foreach ($skillTechnologies as $skillData) {
            Skill::findOrFail($skillData['id'])->technologies()->sync($skillData['technologies']);
        }
    }
}
