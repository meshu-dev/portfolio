<?php

namespace App\Actions\Technology;

use App\Models\Technology;

class DeleteTechnologyAction
{
    /**
     * @param int $userId
     * @param int $id
     * @return bool
     */
    public function execute(int $userId, int $id): bool
    {
        return Technology::where('user_id', $userId)
                         ->where('id', $id)
                         ->delete();
    }
}
