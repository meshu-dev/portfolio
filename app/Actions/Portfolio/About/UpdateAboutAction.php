<?php

namespace App\Actions\Portfolio\About;

use App\Actions\File\GetFileUrlAction;
use App\Http\Resources\SkillResource;
use App\Repositories\{
    TextRepository,
    SkillRepository
};

class UpdateAboutAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SkillRepository $skillRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $aboutImgUrl     = resolve(GetFileUrlAction::class, ['name' => 'about.png'])->execute();
        $textList        = $this->textRepository->getByNames($userId, ["about"])->toArray();
        $portfolioSkills = $this->skillRepository->getByNames($userId, ["Portfolio"]);

        return [
            'image'  => $aboutImgUrl,
            'text'   => $textList['about'],
            'skills' => SkillResource::collection($portfolioSkills)
        ];
    }
}
