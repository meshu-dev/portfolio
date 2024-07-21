<?php

namespace App\Actions\Cv;

use App\Enums\TypeEnum;
use App\Http\Resources\{
    SkillResource,
    SiteResource,
    WorkExperienceResource
};
use App\Repositories\{
    TextRepository,
    SiteRepository,
    SkillRepository,
    WorkExperienceRepository,
    FileRepository
};
use App\Services\CvService;

class GetCvAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected SkillRepository $skillRepository,
        protected WorkExperienceRepository $workExperienceRepository,
        protected FileRepository $fileRepository
    ) { }

    public function execute(): array
    {
        $details         = $this->textRepository->getByNames(['fullname', 'intro', 'location']);
        $sites           = $this->siteRepository->getByNames(TypeEnum::CV);
        $skills          = $this->skillRepository->getByNames(['Backend', 'Frontend', 'Frameworks', 'Misc']);
        $workExperiences = $this->workExperienceRepository->getAll();
        $pdfFile         = $this->fileRepository->getByName('cv.pdf');

        return [
            'profile' => [
                'details' => $details,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfFile->url
        ];
    }
}