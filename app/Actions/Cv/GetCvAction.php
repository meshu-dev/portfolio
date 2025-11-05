<?php

namespace App\Actions\Cv;

use App\Actions\File\GetFileUrlAction;
use App\Actions\Profile\{
    GetSkillsAction,
    GetYearsWorkedAction
};
use App\Enums\{DynamicValueEnum, TypeEnum};
use App\Exceptions\IntroIsNullException;
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

class GetCvAction
{
    public function __construct(
        protected GetSkillsAction $getSkillsAction,
        protected GetYearsWorkedAction $getYearsWorkedAction,
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository,
        protected WorkExperienceRepository $workExperienceRepository,
        protected FileRepository $fileRepository
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
        $pdfFile         = $this->fileRepository->getByName('cv.pdf');

        throw_unless($details['intro'], IntroIsNullException::class, 'CV intro is required');

        $details['intro'] = str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            (string) $this->getYearsWorkedAction->execute(),
            $details['intro']
        );

        if ($pdfFile?->url) {
            $pdfUrl = resolve(GetFileUrlAction::class, ['name' => $pdfFile->name])->execute();
        }

        return [
            'profile' => [
                'details' => $details,
                'sites'   => SiteResource::collection($sites)
            ],
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfUrl ?? null
        ];
    }
}
