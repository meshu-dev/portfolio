<?php

namespace App\Http\Controllers;

use App\Services\PortfolioService;
use Illuminate\Support\Facades\Cache;

class PortfolioController extends Controller
{
    public function __construct(
        protected PortfolioService $portfolioService
    ) {
    }

    /**
     * Get text for portfolio introduction page.
     */
    public function getIntro()
    {
        $introDetails = Cache::get('portfolioIntroDetails');

        if (!$introDetails) {
            $introDetails = $this->portfolioService->getIntroDetails();
            Cache::forever('portfolioIntroDetails', $introDetails);
        }

        return response()->json(['data' => $introDetails]);
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout()
    {
        $about = Cache::get('portfolioAbout');

        if (!$about) {
            $about = $this->portfolioService->getAbout();
            Cache::forever('portfolioAbout', $about);
        }

        return response()->json(['data' => $about]);
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects()
    {
        $projects = Cache::get('portfolioProjects');

        if (!$projects) {
            $projects = $this->portfolioService->getProjects();
            Cache::forever('portfolioProjects', $projects);
        }

        return response()->json(['data' => $projects]);
    }
}
