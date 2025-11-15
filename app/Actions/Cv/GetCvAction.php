<?php

namespace App\Actions\Cv;

use App\Actions\File\GetFileUrlAction;
use App\Actions\Portfolio\GetDynamicTextAction;
use App\Actions\Profile\{
    GetSkillsAction,
    GetYearsWorkedAction
};
use App\Enums\TypeEnum;
use App\Http\Resources\{
    SkillResource,
    SiteResource,
    WorkExperienceResource
};
use App\Repositories\{
    TextRepository,
    SiteRepository,
    WorkExperienceRepository
};

class GetCvAction
{
    public function __construct(
        protected GetSkillsAction $getSkillsAction,
        protected GetYearsWorkedAction $getYearsWorkedAction,
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): array
    {
        $details         = $this->textRepository->getByNames(['fullname', 'intro', 'location']);
        $sites           = $this->siteRepository->getByNames(TypeEnum::CV);
        $skills          = $this->getSkillsAction->execute();
        $workExperiences = $this->workExperienceRepository->getAllActive();

        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);
        $pdfUrl = resolve(GetFileUrlAction::class, ['name' => 'cv.pdf'])->execute();

        return [
            'profile' => [
                'details' => $details,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfUrl,
        ];
    }
}
