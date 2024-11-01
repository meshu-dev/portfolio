<?php

namespace App\Services;

use App\Enums\{SkillEnum, ProfileEnum};
use App\Repositories\SkillRepository;
use Carbon\Carbon;

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

    public function getSkills()
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
