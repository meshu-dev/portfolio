<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GitHubService
{
    public function getStreakStats(): string
    {
        $response = Http::get(config('github.streak_stats_url'));
        return $response;
    }
}
