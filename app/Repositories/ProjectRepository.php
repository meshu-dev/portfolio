<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAll()
    {
        return Project::with(['repositories', 'technologies', 'files'])->get();
    }
}
