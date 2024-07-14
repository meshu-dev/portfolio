<?php

namespace App\Services;

use App\Repositories\{
    TextRepository,
    IconRepository,
    SkillRepository,
    WorkExperienceRepository
};

class CvService
{
    public function __construct(
        protected TextRepository $textRepository,
        protected IconRepository $iconRepository,
        protected SkillRepository $skillRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    public function getData()
    {
        $details         = $this->textRepository->getByNames(["fullname", "intro", "location"]);
        $icons           = $this->iconRepository->getAll();
        $skills          = $this->skillRepository->getByNames(["Backend", "Frontend", "Frameworks", "Misc"]);
        $workExperiences = $this->workExperienceRepository->getAll();

        return [
            'profile' => [
                'details' => $details,
                'icons'   => $icons
            ],
            'skill_groups'     => $skills,
            'work_experiences' => $workExperiences
        ];
    }
}
