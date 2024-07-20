<?php

namespace App\Http\Controllers;

use App\Enums\CacheEnum;
use App\Actions\Portfolio\{
    GetIntroAction,
    GetAboutAction,
    GetProjectsAction
};
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro(GetIntroAction $getIntroAction)
    {
        $data = Cache::get(CacheEnum::PortfolioIntro->value);

        if (!$data) {
            $data = $getIntroAction->execute();
            Cache::forever(CacheEnum::PortfolioIntro->value, $data);
        }
        return response()->json(['data' => $data]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction)
    {
        $data = Cache::get(CacheEnum::PortfolioAbout->value);

        if (!$data) {
            $data = $getAboutAction->execute();
            Cache::forever(CacheEnum::PortfolioAbout->value, $data);
        }
        return response()->json(['data' => $data]);
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects(GetProjectsAction $getProjectsAction)
    {
        $data = Cache::get(CacheEnum::PortfolioProjects->value);

        if (!$data) {
            $data = $getProjectsAction->execute();
            Cache::forever(CacheEnum::PortfolioProjects->value, $data);
        }
        return response()->json(['data' => $data]);
    }
}
