<?php

namespace App\Actions\GitHub;

use App\Services\ProfileService;
use Illuminate\Support\Facades\Http;

class GetProfileAction
{
    public function __construct(
        protected ProfileService $profileService,
    ) {
    }

    public function execute(): array
    {
        $streakStats = Http::get(config('github.streak_stats_url'));
        $readMeStats = Http::get(config('github.readme_stats_url'));
        $skills = $this->profileService->getSkills();
        //$skillBadges = $this->profileService->getSkillBadges();

        return [
            'streakStats' => $streakStats,
            'readMeStats' => $readMeStats,
            'skills'      => $skills
        ];
    }
}
