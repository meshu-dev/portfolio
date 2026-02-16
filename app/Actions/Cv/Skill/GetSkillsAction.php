<?php

namespace App\Actions\Cv\Skill;

use App\Enums\SkillEnum;
use App\Models\Skill;
use App\Repositories\SkillRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetSkillsAction
{
    public function __construct(
        protected SkillRepository $skillRepository
    ) {
    }

    /**
     * @return Collection<int, Skill>
     */
    public function execute(): Collection
    {
        $profileSkills = [
            SkillEnum::BACKEND->value,
            SkillEnum::FRONTEND->value,
            SkillEnum::FRAMEWORKS->value,
            SkillEnum::MISC->value,
        ];

        return $this->skillRepository->getByNames(Auth::id(), $profileSkills);
    }
}
