<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\SkillResource;
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
        $portfolioSkills = $this->skillRepository->getByNames(["Portfolio"]);

        return [
            'text'   => $textList['about'],
            'skills' => SkillResource::collection($portfolioSkills)
        ];
    }
}