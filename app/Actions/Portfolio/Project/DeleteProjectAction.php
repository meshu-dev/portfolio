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
        return Project::where('user_id', Auth::id())
                      ->where('id', $id)
                      ->delete();
    }
}
