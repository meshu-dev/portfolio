<?php

namespace App\Actions\Portfolio\About;

use App\Actions\Cv\Skill\UpdateSkillTechnologiesAction;
use App\Enums\SkillEnum;
use App\Models\About;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class UpdateAboutAction
{
    /**
     * @param string $text
     * @param array<int, string> $technologyIds
     */
    public function execute(string $text, array $technologyIds): void
    {
        $userId = (int) Auth::id();

        About::where('user_id', $userId)->update(['text' => $text]);

        $skill = Skill::where('user_id', $userId)
                      ->where('name', SkillEnum::PORTFOLIO->value)
                      ->firstOrFail();

        $skillTechnologies = [['id' => $skill->id, 'technologies' => $technologyIds]];

        resolve(UpdateSkillTechnologiesAction::class)->execute($skillTechnologies);
    }
}
