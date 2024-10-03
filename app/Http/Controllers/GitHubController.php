<?php

namespace App\Http\Controllers;

use App\Actions\GitHub\{GetStreakStatsAction, GetTechStatsAction};

class GitHubController extends Controller
{
    /**
     * Get HTML for GitHub streak stats page.
     */
    public function getStreakStats(GetStreakStatsAction $getStreakStatsAction)
    {
        $streakStats = $getStreakStatsAction->execute();

        return response($streakStats, 200)->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Get HTML for GitHub streak stats page.
     */
    public function getTechStats(GetTechStatsAction $getTechStatsAction)
    {
        $techStats = $getTechStatsAction->execute();

        return response($techStats, 200)->header('Content-Type', 'image/svg+xml');
    }
}
