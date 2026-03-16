<?php

namespace App\Actions\Portfolio\Project;

use App\Models\Project;
use Illuminate\Support\Collection;

class GetProjectsAction
{
    /**
     * @return Collection<int, Project>
     */
    public function execute(int $userId): Collection
    {
        return Project::where('user_id', $userId)->get();
    }
}
