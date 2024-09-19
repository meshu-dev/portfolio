<?php

namespace App\Actions\GitHub;

use App\Services\ProfileService;
use Illuminate\Support\Facades\{Cache, Http};

class GetProfileAction
{
    public function __construct(
        protected ProfileService $profileService,
    ) {
    }

    public function execute(): array
    {
        $streakStats = Cache::remember('streakStats', config('github.streak_stats_cache_in_seconds'), function () {
            return Http::get(config('github.streak_stats_url'))->body();
        });

        $readMeStats = Cache::remember('readMeStats', config('github.readme_stats_cache_in_seconds'), function () {
            return Http::get(config('github.readme_stats_url'))->body();
        });

        $skills = $this->profileService->getSkills();

        return [
            'streakStats' => $streakStats,
            'readMeStats' => $readMeStats,
            'skills'      => $skills
        ];
    }
}
