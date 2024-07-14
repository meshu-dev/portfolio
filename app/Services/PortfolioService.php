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
        $aboutText       = $this->textRepository->getByNames(["about"]);
        $portfolioSkills = $this->skillRepository->getByNames(["portfolio"]);

        return [
            'text'   => $aboutText,
            'skills' => $portfolioSkills
        ];
    }

    public function getProjects()
    {
        return $this->projectRepository->getAll();
    }
}
