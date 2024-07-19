<?php

namespace App\Http\Controllers;

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
        $data = Cache::get('portfolio-intro');

        //if (!$data) {
            $data = $getIntroAction->execute();
            Cache::forever('portfolio-intro', $data);
        //}

        return response()->json(['data' => $data]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout(GetAboutAction $getAboutAction)
    {
        $data = Cache::get('portfolio-about');

        // if (!$data) {
            $data = $getAboutAction->execute();
            Cache::forever('portfolio-about', $data);
        //}

        return response()->json(['data' => $data]);
    }
}
