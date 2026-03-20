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
    ProfileResource,
    SiteResource,
    SkillResource,
    WorkExperienceResource
};

class GetCvAction
{
    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $profile         = resolve(GetProfileAction::class)->execute($userId);
        $sites           = resolve(GetSitesByTypeAction::class)->execute(TypeEnum::CV);
        $skills          = resolve(GetSkillsAction::class)->execute($userId);
        $workExperiences = resolve(GetWorkExperiencesAction::class)->execute($userId, true);
        $pdfUrl          = resolve(GetPdfFileUrlAction::class)->execute();

        return [
            'profile'          => resolve(ProfileResource::class, ['resource' => $profile]),
            'sites'            => SiteResource::collection($sites),
            'skills'           => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfUrl,
        ];
    }
}
