<?php

namespace App\Repositories;

use App\Models\WorkExperience;
use Illuminate\Support\Collection;

class WorkExperienceRepository
{
    /**
     * @return Collection<int, WorkExperience>
     */
    public function getAllActive(): Collection
    {
        return WorkExperience::where('active', true)->get();
    }
}
