<?php

namespace App\Actions\Cv\WorkExperience;

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
    public function execute(int $userId, bool $activeOnly = false): Collection
    {
        if ($activeOnly) {
            return $this->workExperienceRepository->getAllActive($userId);
        }
        return $this->workExperienceRepository->getAll($userId);
    }
}
