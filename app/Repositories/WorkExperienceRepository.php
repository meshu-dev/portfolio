<?php

namespace App\Repositories;

use App\Models\WorkExperience;
use Illuminate\Support\Collection;

class WorkExperienceRepository
{
    /**
     * @param int $userId
     * @return Collection<int, WorkExperience>
     */
    public function getAllActive(int $userId): Collection
    {
        return WorkExperience::where('user_id', $userId)
                             ->where('active', true)
                             ->get();
    }

    /**
     * @return Collection<int, WorkExperience>
     */
    public function getAll(int $userId): Collection
    {
        return WorkExperience::select('id', 'title', 'company', 'location')
                             ->where('user_id', $userId)
                             ->get();
    }

    /**
     * @param int $id
     * @param array<string, mixed> $params
     * @return WorkExperience
     */
    public function update(int $userId, int $id, array $params): bool
    {
        return WorkExperience::where('user_id', $userId)
                             ->where('id', $id)
                             ->update($params);
    }
}
