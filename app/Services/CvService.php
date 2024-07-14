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

    public function get()
    {
        $details         = $this->textRepository->getKeyValues();
        $icons           = $this->iconRepository->getAll();
        $skills          = $this->skillRepository->getCvSkills();
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
