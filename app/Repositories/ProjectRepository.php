<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository
{
    /**
     * @return Collection<int, Project>
     */
    public function getAll(int $userId): Collection
    {
        return Project::where('user_id', $userId)->get();
    }

    /**
     * @return Project
     */
    public function get(int $userId, string $projectId): Project
    {
        return Project::with(['repositories', 'technologies', 'files'])
                      ->where('user_id', $userId)
                      ->where('id', $projectId)
                      ->firstOrFail();
    }
}
