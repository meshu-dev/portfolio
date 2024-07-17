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
        return $this->getData('portfolio-intro-details', 'getIntroDetails');
    }

    /**
     * Get text and skills list for the portfolio about page.
     */
    public function getAbout()
    {
        return $this->getData('portfolio-about', 'getAbout');
    }

    /**
     * Get projects for the portfolio projects page.
     */
    public function getProjects()
    {
        return $this->getData('portfolio-projects', 'getProjects');
    }

    protected function getData(string $cacheKey, string $function)
    {
        $data = Cache::get($cacheKey);

        if (!$data) {
            $data = $this->portfolioService->{$function}();
            Cache::forever($cacheKey, $data);
        }

        return response()->json(['data' => $data]);
    }
}
