<?php

return [
    'streak_stats_url'              => env('GITHUB_STREAK_STATS_URL', 'https://streak-stats.demolab.com?user=meshu-dev&mode=weekly'),
    'streak_stats_cache_in_seconds' => env('GITHUB_STREAK_STATS_CACHE_IN_SECONDS', 86400),
    'readme_stats_url'              => env('GITHUB_README_STATS_URL', 'https://github-readme-stats.vercel.app/api/top-langs/?username=meshu-dev&langs_count=6&layout=compact'),
    'readme_stats_cache_in_seconds' => env('GITHUB_STREAK_STATS_CACHE_IN_SECONDS', 86400),
    'shield_badges_url'             => env('GITHUB_SHIELD_BADDGES', 'https://img.shields.io/badge'),
];
