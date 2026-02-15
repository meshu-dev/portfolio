<?php

namespace App\Actions\Cv;

use App\Models\WorkExperience;
use App\Repositories\WorkExperienceRepository;
use Illuminate\Support\Collection;

class GetWorkExperiencesAction
{
    public function __construct(
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    /**
     * @return Collection<int, WorkExperience>
     */
    public function execute(bool $activeOnly = false): Collection
    {
        if ($activeOnly) {
            return $this->workExperienceRepository->getAllActive();
        }
        return $this->workExperienceRepository->getAll();
    }
}
