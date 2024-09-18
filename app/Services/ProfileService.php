<?php

namespace App\Services;

use App\Enums\{SkillEnum, ProfileEnum};
use App\Repositories\SkillRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

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
        return floor($yearsWorked);
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

    public function getSkillBadges()
    {
        $badgeUrl    = config('github.shield_badges_url');
        $skills      = $this->getSkills();
        $skillBadges = [];

        foreach ($skills as $skill) {
            $badges = [];

            foreach ($skill->technologies as $technology) {
                $badge      = $technology->badge;
                $iconColour = urlencode($badge->icon_colour);
                $logoColour = urlencode($badge->logo_colour);

                $badges[] = Http::get("$badgeUrl/{$badge->icon}-$iconColour?style=for-the-badge&logo={$badge->logo}&logoColor=$logoColour");
            }

            $skillBadges[] = [
                'name'   => $skill->name,
                'badges' => $badges
            ];
        }
        return $skillBadges;
    }
}
