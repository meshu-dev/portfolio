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
     * @param array<string, int> $technologies
     */
    public function execute(string $text, array $technologies): void
    {
        $userId = (int) Auth::id();

        About::where('user_id', $userId)->update(['text' => $text]);

        $skill = Skill::where('user_id', $userId)
                      ->where('name', SkillEnum::PORTFOLIO->value)
                      ->firstOrFail();

        $skillTechnologies = ['id' => $skill->id, 'technologies' => $technologies];

        resolve(UpdateSkillTechnologiesAction::class)->execute($skillTechnologies);
    }
}
