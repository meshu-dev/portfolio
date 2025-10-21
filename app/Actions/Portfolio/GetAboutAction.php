<?php

namespace App\Actions\Portfolio;

use App\Actions\File\GetFileUrlAction;
use App\Http\Resources\SkillResource;
use App\Repositories\{
    TextRepository,
    SkillRepository
};

class GetAboutAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SkillRepository $skillRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): array
    {
        $aboutImgUrl     = resolve(GetFileUrlAction::class, ['name' => 'about.png'])->execute();
        $textList        = $this->textRepository->getByNames(["about"])->toArray();
        $portfolioSkills = $this->skillRepository->getByNames(["Portfolio"]);

        return [
            'image'  => $aboutImgUrl,
            'text'   => $textList['about'],
            'skills' => SkillResource::collection($portfolioSkills)
        ];
    }
}
