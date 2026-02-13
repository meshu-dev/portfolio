<?php

namespace App\Actions\Cv;

use App\Actions\File\GetFileUrlAction;
use App\Http\Resources\{
    SkillResource,
    WorkExperienceResource
};
use App\Repositories\WorkExperienceRepository;

class GetCvAction
{
    public function __construct(
        protected GetProfileAction $getDataAction,
        protected GetSkillsAction $getSkillsAction,
        protected GetYearsWorkedAction $getYearsWorkedAction,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(): array
    {
        $data            = $this->getDataAction->execute();
        $skills          = $this->getSkillsAction->execute();
        $workExperiences = $this->workExperienceRepository->getAllActive();

        $pdfUrl = resolve(GetFileUrlAction::class, ['name' => 'cv.pdf'])->execute();

        return [
            'profile'          => $data,
            'skill_groups'     => SkillResource::collection($skills),
            'work_experiences' => WorkExperienceResource::collection($workExperiences),
            'pdf'              => $pdfUrl,
        ];
    }
}
