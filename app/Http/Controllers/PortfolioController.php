<?php

namespace App\Http\Controllers;

use App\Actions\Portfolio\{
    GetIntroAction,
    GetAboutAction,
    GetProjectsAction
};

class PortfolioController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro(GetIntroAction $getIntroAction)
    {
        $data = $getIntroAction->execute();
        return response()->json(['data' => $data]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction)
    {
        $data = $getAboutAction->execute();
        return response()->json(['data' => $data]);
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects(GetProjectsAction $getProjectsAction)
    {
        $data = $getProjectsAction->execute();
        return response()->json(['data' => $data]);
    }
}
