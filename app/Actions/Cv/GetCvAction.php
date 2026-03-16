<?php

namespace App\Actions\Cv;

use App\Actions\Cv\{
    Profile\GetProfileAction,
    Skill\GetSkillsAction,
    WorkExperience\GetWorkExperiencesAction,
};
use App\Actions\File\GetPdfFileUrlAction;
use App\Actions\Site\GetSitesByTypeAction;
use App\Enums\TypeEnum;
use App\Http\Resources\{
    SiteResource,
    SkillResource,
    WorkExperienceResource
};

class GetCvAction
{
    public function __construct(
        protected GetProfileAction $getProfileAction,
        protected GetSitesByTypeAction $getSitesAction,
        protected GetSkillsAction $getSkillsAction,
        protected GetWorkExperiencesAction $getWorkExperiencesAction,
    ) {
    }

    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $profile         = $this->getProfileAction->execute($userId);
        $sites           = $this->getSitesAction->execute(TypeEnum::CV);
        $skills          = $this->getSkillsAction->execute($userId);
        $workExperiences = $this->getWorkExperiencesAction->execute($userId, true);
        $pdfUrl          = resolve(GetPdfFileUrlAction::class)->execute();

        return [
            'profile' => [
                'details' => $profile,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfUrl,
        ];
    }
}
