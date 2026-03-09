<?php

namespace App\Repositories;

use App\Models\Project;
use App\Models\Repository;
use Illuminate\Support\Collection;

class RepoRepository
{
    /**
     * @return Collection<int, Repository>
     */
    public function getAll(int $userId): Collection
    {
        return Repository::where('user_id', $userId)->get();
    }

    /**
     * @return Repository
     */
    public function get(int $userId, string $repoId): Repository
    {
        return Repository::where('user_id', $userId)->where('id', $repoId)->firstOrFail();
    }
}
