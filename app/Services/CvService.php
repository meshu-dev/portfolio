<?php

namespace App\Services;

use App\Repositories\{
    ProfileDetailRepository,
    ProfileLinkRepository,
    SkillTypeRepository,
    WorkExperienceRepository
};

class CvService
{
    public function __construct(
        protected ProfileDetailRepository $profileDetailRepository,
        protected ProfileLinkRepository $profileLinkRepository,
        protected SkillTypeRepository $skillTypeRepository,
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    public function get()
    {
        return [
            'profile' => [
                'details' => $this->profileDetailRepository->getAll(),
                'links'   => $this->profileLinkRepository->getAll()
            ],
            'skills' => [
                $this->skillTypeRepository->getAll()
            ],
            'workExperiences' => [
                $this->workExperienceRepository->getAll()
            ]
        ];
    }
}
