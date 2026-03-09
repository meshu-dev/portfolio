<?php

namespace App\Actions\Portfolio\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class UpsertProjectAction
{
    /**
     * @param array<string, mixed> $params
     */
    public function execute(array $params): void
    {
        $userId = Auth::id();

        if (!empty($params['id'])) {
            $id = $params['id'];
            unset($params['id']);

            $project = Project::where('user_id', $userId)
                              ->where('id', $id)
                              ->firstOrFail();

            $project->update([
                'name'        => $params['name'],
                'description' => $params['description'],
                'url'         => $params['url'],
            ]);

        } else {
            $params['user_id'] = $userId;
            $project = Project::create($params);
        }
        $project->repositories()->sync($params['repositories']);
        $project->technologies()->sync($params['technologies']);
    }
}
