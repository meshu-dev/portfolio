<?php

namespace App\Http\Controllers;

use App\Actions\GitHub\{GetStreakStatsAction, GetTechStatsAction};
use Illuminate\Http\Response;

class GitHubController extends Controller
{
    /**
     * Get HTML for GitHub streak stats page.
     */
    public function getStreakStats(GetStreakStatsAction $getStreakStatsAction): Response
    {
        $streakStats = $getStreakStatsAction->execute();

        return response($streakStats, Response::HTTP_OK)->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Get HTML for GitHub streak stats page.
     */
    public function getTechStats(GetTechStatsAction $getTechStatsAction): Response
    {
        $techStats = $getTechStatsAction->execute();

        return response($techStats, Response::HTTP_OK)->header('Content-Type', 'image/svg+xml');
    }
}
