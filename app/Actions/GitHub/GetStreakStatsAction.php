<?php

namespace App\Actions\GitHub;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GetStreakStatsAction
{
    public function execute(): string
    {
        $cache = Cache::get('streak_stats');

        if (!$cache) {
            $statsUrl = config('github.streak_stats.url');
            $response = Http::get($statsUrl);

            if ($response->successful()) {
                $svg            = $response->body();
                $cacheInSeconds = config('github.streak_stats.cache_in_seconds');

                Cache::put('streak_stats', $svg, $cacheInSeconds);

                return $svg;
            }
        }

        return $cache;
    }
}
