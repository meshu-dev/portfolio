<?php

namespace App\Services;

use App\Repositories\{
    ProfileDetailRepository,
    ProfileLinkRepository,
    SkillRepository,
    WorkExperienceRepository
};

class CvService
{
    public function __construct(
        protected ProfileDetailRepository $profileDetailRepository,
        protected ProfileLinkRepository $profileLinkRepository,
        protected SkillRepository $skillRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    public function get()
    {
        $details         = $this->profileDetailRepository->getKeyValues();
        $links           = $this->profileLinkRepository->getAll();
        $skills          = $this->skillRepository->getAll();
        $workExperiences = $this->workExperienceRepository->getAll();

        return [
            'profile' => [
                'details' => $details,
                'links'   => $links
            ],
            'skill_groups'     => $skills,
            'work_experiences' => $workExperiences
        ];
    }
}
