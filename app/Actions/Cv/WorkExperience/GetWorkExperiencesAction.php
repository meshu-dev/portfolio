<?php

namespace App\Actions\Cv\WorkExperience;

use App\Models\WorkExperience;
use App\Repositories\WorkExperienceRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

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
            return $this->workExperienceRepository->getAllActive(Auth::id());
        }
        return $this->workExperienceRepository->getAll(Auth::id());
    }
}
