<?php

namespace App\Actions\Portfolio\Project;

use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetProjectsAction
{
    /**
     * @return array<string, AnonymousResourceCollection<int, Project>>
     */
    public function execute(int $userId): array
    {
        return Project::where('user_id', $userId)->get();
    }
}
