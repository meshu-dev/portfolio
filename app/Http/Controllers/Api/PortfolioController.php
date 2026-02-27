<?php

namespace App\Http\Controllers\Api;

use App\Actions\Portfolio\{
    GetIntroAction,
    GetAboutAction,
    GetProjectsAction
};
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro(GetIntroAction $getIntroAction): JsonResponse
    {
        $data = $getIntroAction->execute(Auth::id());
        return response()->json(['data' => $data]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction): JsonResponse
    {
        $data = $getAboutAction->execute(Auth::id());
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
