<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Support\Collection;

class ProjectRepository
{
    /**
     * @return Collection<int, Project>
     */
    public function getAll(): Collection
    {
        return Project::with(['repositories', 'technologies', 'files'])->get();
    }
}
