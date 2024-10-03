<?php

return [
    'streak_stats' => [
        'url' => env('GITHUB_STREAK_STATS_URL', 'https://streak-stats.demolab.com?user=meshu-dev&mode=weekly'),
        'cache_in_seconds' => env('GITHUB_STREAK_STATS_CACHE_IN_SECONDS', 86400),
    ],
    'tech_stats' => [
        'url' => env('GITHUB_README_STATS_URL', 'https://github-readme-stats.vercel.app/api/top-langs/?username=meshu-dev&langs_count=6&layout=compact'),
        'cache_in_seconds' => env('GITHUB_README_STATS_CACHE_IN_SECONDS', 86400),
    ],
];
