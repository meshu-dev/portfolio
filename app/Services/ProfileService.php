<?php

namespace App\Services;

use App\Enums\{SkillEnum, ProfileEnum};
use App\Repositories\SkillRepository;
use App\Models\Skill;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProfileService
{
    public function __construct(
        protected SkillRepository $skillRepository
    ) {
    }

    public function getYearsWorked(): int
    {
        $workStartDate = Carbon::parse(ProfileEnum::WORK_START_DATE->value);

        $yearsWorked = $workStartDate->diffInYears(Carbon::now());
        return (int) floor($yearsWorked);
    }

    /**
     * @return Collection<int, Skill>
     */
    public function getSkills(): Collection
    {
        $profileSkills = [
            SkillEnum::BACKEND->value,
            SkillEnum::FRONTEND->value,
            SkillEnum::FRAMEWORKS->value,
            SkillEnum::MISC->value,
        ];

        return $this->skillRepository->getByNames($profileSkills);
    }
}
