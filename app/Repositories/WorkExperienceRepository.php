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

    /**
     * @return Collection<int, WorkExperience>
     */
    public function getAll(): Collection
    {
        return WorkExperience::select('id', 'title', 'company', 'location')->get();
    }

    /**
     * @param int $id
     * @param array<string, mixed> $params
     * @return WorkExperience
     */
    public function update(int $id, array $params): bool
    {
        return WorkExperience::where('id', $id)->update($params);
    }
}
