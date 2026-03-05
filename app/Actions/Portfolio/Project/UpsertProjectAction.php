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

            Project::where('user_id', $userId)
                   ->where('id', $id)
                   ->update($params);
        } else {
            $params['user_id'] = $userId;
            Project::create($params);
        }
    }
}
