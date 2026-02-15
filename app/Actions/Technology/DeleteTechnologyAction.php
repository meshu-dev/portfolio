<?php

namespace App\Actions\Technology;

use App\Models\Technology;

class DeleteTechnologyAction
{
    /**
     * @param int $id
     */
    public function execute(int $id): bool
    {
        return Technology::destroy($id);
    }
}
