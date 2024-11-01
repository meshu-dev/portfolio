<?php

namespace App\Actions\Cv;

use App\Enums\{DynamicValueEnum, TypeEnum};
use App\Http\Resources\{
    SkillResource,
    SiteResource,
    WorkExperienceResource
};
use App\Repositories\{
    TextRepository,
    SiteRepository,
    WorkExperienceRepository,
    FileRepository
};
use App\Services\ProfileService;

class GetCvAction
{
    public function __construct(
        protected ProfileService $profileService,
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected WorkExperienceRepository $workExperienceRepository,
        protected FileRepository $fileRepository
    ) {
    }

    public function execute(): array
    {
        $details         = $this->textRepository->getByNames(['fullname', 'intro', 'location']);
        $sites           = $this->siteRepository->getByNames(TypeEnum::CV);
        $skills          = $this->profileService->getSkills();
        $workExperiences = $this->workExperienceRepository->getAllActive();
        $pdfFile         = $this->fileRepository->getByName('cv.pdf');

        $details['intro'] = str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            (string) $this->profileService->getYearsWorked(),
            $details['intro']
        );

        return [
            'profile' => [
                'details' => $details,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfFile?->url ?? null
        ];
    }
}
