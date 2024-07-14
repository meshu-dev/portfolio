<?php

namespace App\Services;

use App\Repositories\{
    TextRepository,
    SkillRepository,
    ProjectRepository
};

class PortfolioService
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SkillRepository $skillRepository,
        protected ProjectRepository $projectRepository
    ) {
    }

    public function getIntroDetails()
    {
        return $this->textRepository->getByNames(["portfolio_intro_1", "portfolio_intro_2"]);
    }

    public function getAbout()
    {
        $textList        = $this->textRepository->getByNames(["about"])->toArray();
        $portfolioSkills = $this->skillRepository->getByNames(["portfolio"]);

        return [
            'text'   => $textList['about'],
            'skills' => $portfolioSkills
        ];
    }

    public function getProjects()
    {
        return $this->projectRepository->getAll();
    }
}
