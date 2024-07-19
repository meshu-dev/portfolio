<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\{
    SkillResource,
    SiteResource,
    WorkExperienceResource
};
use App\Repositories\{
    TextRepository,
    SkillRepository
};
use App\Services\CvService;

class GetAboutAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SkillRepository $skillRepository
    ) { }

    public function execute(): array
    {
        $textList        = $this->textRepository->getByNames(["about"])->toArray();
        $portfolioSkills = $this->skillRepository->getByNames(["portfolio"]);

        return [
            'text'   => $textList['about'],
            'skills' => $portfolioSkills
        ];
    }
}