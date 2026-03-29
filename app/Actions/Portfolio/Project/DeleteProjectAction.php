<?php

namespace App\Actions\Portfolio\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class DeleteProjectAction
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        $project = Project::where('user_id', Auth::id())
                          ->where('id', $id)
                          ->firstOrFail();

        $project->image->delete();

        return $project->delete();
    }
}
