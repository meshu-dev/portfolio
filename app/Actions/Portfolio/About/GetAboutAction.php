<?php

namespace App\Actions\Portfolio\About;

use App\Actions\File\GetFileUrlAction;
use App\Enums\SkillEnum;
use App\Models\About;
use App\Repositories\TechnologyRepository;

class GetAboutAction
{
    public function __construct(
        protected TechnologyRepository $technologyRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $aboutImgUrl       = resolve(GetFileUrlAction::class, ['name' => 'about.png'])->execute();
        $about             = About::where('user_id', $userId)->firstOrFail();
        $skillTechnologies = $this->technologyRepository->getBySkill($userId, SkillEnum::PORTFOLIO);

        return [
            'image'             => $aboutImgUrl,
            'text'              => $about->text,
            'skillTechnologies' => $skillTechnologies,
        ];
    }
}
