<?php

namespace App\Actions\GitHub;

use App\Services\GitHubService;
use Illuminate\Support\Facades\Http;

class GetProfileAction
{
    public function __construct(
        protected GitHubService $gitHubService
    ) {
    }

    public function execute(): array
    {
        $streakStats = Http::get(config('github.streak_stats_url'));
        $readMeStats = Http::get(config('github.readme_stats_url'));

        return [
            'streakStats' => $streakStats,
            'readMeStats' => $readMeStats
        ];
    }
}