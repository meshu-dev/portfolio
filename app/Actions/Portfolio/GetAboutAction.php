<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\SkillResource;
use App\Repositories\{
    FileRepository,
    TextRepository,
    SkillRepository
};

class GetAboutAction
{
    public function __construct(
        protected FileRepository $fileRepository,
        protected TextRepository $textRepository,
        protected SkillRepository $skillRepository
    ) {
    }

    public function execute(): array
    {
        $aboutFile       = $this->fileRepository->getByName('about.png');
        $textList        = $this->textRepository->getByNames(["about"])->toArray();
        $portfolioSkills = $this->skillRepository->getByNames(["Portfolio"]);

        return [
            'image'  => $aboutFile ? $aboutFile->url : null,
            'text'   => $textList['about'],
            'skills' => SkillResource::collection($portfolioSkills)
        ];
    }
}