<?php

namespace App\Http\Controllers\Api;

use App\Actions\Portfolio\{
    GetPortfolioAction,
    Intro\GetIntroAction,
    About\GetAboutAction,
    Project\GetProjectsAction
};
use App\Http\Controllers\Controller;
use App\Http\Resources\{AboutResource, IntroResource, ProjectResource};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    public function get(GetPortfolioAction $getPortfolioAction): JsonResponse
    {
        $data = $getPortfolioAction->execute((int) Auth::id());

        return response()->json([
            'data' => [
                'intro'    => resolve(IntroResource::class, ['resource' => $data['intro']]),
                'about'    => resolve(AboutResource::class, ['resource' => $data['about']]),
                'projects' => ProjectResource::collection($data['projects']),
            ],
        ]);
    }

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
