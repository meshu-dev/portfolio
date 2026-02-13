<?php

namespace App\Http\Controllers;

use App\Actions\Portfolio\{
    GetIntroAction,
    GetAboutAction,
    GetProjectsAction
};
use Illuminate\Http\JsonResponse;

class PortfolioController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro(GetIntroAction $getIntroAction): JsonResponse
    {
        $data = $getIntroAction->execute();
        return response()->json(['data' => $data]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction): JsonResponse
    {
        $data = $getAboutAction->execute();
        return response()->json(['data' => $data]);
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects(GetProjectsAction $getProjectsAction): JsonResponse
    {
        $data = $getProjectsAction->execute();
        return response()->json(['data' => $data]);
    }
}
