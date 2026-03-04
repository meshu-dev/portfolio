<?php

namespace App\Actions\Portfolio\About;

use App\Actions\File\GetFileUrlAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\SkillEnum;
use App\Repositories\{
    TextRepository,
    TechnologyRepository
};

class GetAboutAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected TechnologyRepository $technologyRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $aboutImgUrl       = resolve(GetFileUrlAction::class, ['name' => 'about.png'])->execute();
        $textList          = $this->textRepository->getByNames($userId, ["about"])->toArray();
        $skillTechnologies = $this->technologyRepository->getBySkill($userId, SkillEnum::PORTFOLIO);
        $technologies      = resolve(GetAllTechnologiesAction::class)->execute();

        return [
            'image'             => $aboutImgUrl,
            'text'              => $textList['about'],
            'skillTechnologies' => $skillTechnologies,
        ];
    }
}
