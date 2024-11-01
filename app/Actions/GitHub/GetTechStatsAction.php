<?php

namespace App\Actions\GitHub;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class GetTechStatsAction
{
    public function execute(): string
    {
        $cache = Cache::get('tech_stats');

        if (!$cache) {
            $statsUrl = config('github.tech_stats.url');
            $response = Http::get($statsUrl);

            if ($response->successful()) {
                $svg            = $response->body();
                $cacheInSeconds = config('github.tech_stats.cache_in_seconds');

                Cache::put('tech_stats', $svg, $cacheInSeconds);

                return $svg;
            }
        }

        return $cache;
    }
}
