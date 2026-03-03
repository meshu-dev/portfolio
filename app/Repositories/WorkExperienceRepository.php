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
                             ->orderByDesc('start_date')
                             ->get();
    }

    /**
     * @return Collection<int, WorkExperience>
     */
    public function getAll(int $userId): Collection
    {
        return WorkExperience::select('id', 'title', 'company', 'location')
                             ->where('user_id', $userId)
                             ->orderByDesc('start_date')
                             ->get();
    }

    /**
     * @param array<string, mixed> $params
     * @return WorkExperience
     */
    public function create(array $params): WorkExperience
    {
        return WorkExperience::create($params);
    }

    /**
     * @param int $userId
     * @param string $id
     * @param array<string, mixed> $params
     * @return WorkExperience
     */
    public function update(int $userId, string $id, array $params): bool
    {
        return WorkExperience::where('user_id', $userId)
                             ->where('id', $id)
                             ->update($params);
    }
}
