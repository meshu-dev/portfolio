<?php

namespace App\Actions\Cv;

use App\Actions\Cv\{
    Profile\GetProfileAction,
    Skill\GetSkillsAction,
    WorkExperience\GetWorkExperiencesAction,
};
use App\Actions\File\GetFileUrlAction;
use App\Http\Resources\{
    SiteResource,
    SkillResource,
    WorkExperienceResource
};

class GetCvAction
{
    public function __construct(
        protected GetProfileAction $getProfileAction,
        protected GetSitesAction $getSitesAction,
        protected GetSkillsAction $getSkillsAction,
        protected GetWorkExperiencesAction $getWorkExperiencesAction,
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): array
    {
        $profile         = $this->getProfileAction->execute();
        $sites           = $this->getSitesAction->execute();
        $skills          = $this->getSkillsAction->execute();
        $workExperiences = $this->getWorkExperiencesAction->execute(true);
        $pdfUrl          = resolve(GetFileUrlAction::class, ['name' => 'cv.pdf'])->execute();

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
