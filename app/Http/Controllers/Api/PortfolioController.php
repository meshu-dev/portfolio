<?php

namespace App\Http\Controllers\Api;

use App\Actions\Portfolio\{
    Intro\GetIntroAction,
    About\GetAboutAction,
    Project\GetProjectsAction
};
use App\Http\Controllers\Controller;
use App\Http\Resources\{AboutResource, IntroResource, ProjectResource};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro(GetIntroAction $getIntroAction): IntroResource
    {
        $intro = $getIntroAction->execute((int) Auth::id());
        return new IntroResource($intro);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction): AboutResource
    {
        $about = $getAboutAction->execute((int) Auth::id());
        return new AboutResource($about);
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects(GetProjectsAction $getProjectsAction): AnonymousResourceCollection
    {
        $projects = $getProjectsAction->execute((int) Auth::id());
        return ProjectResource::collection($projects);
    }
}
