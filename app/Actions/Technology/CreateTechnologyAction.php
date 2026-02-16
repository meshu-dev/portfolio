<?php

namespace App\Actions\Technology;

use App\Models\Technology;

class CreateTechnologyAction
{
    /**
     * @param int $userId
     * @param string $name
     */
    public function execute(int $userId, string $name): void
    {
        Technology::create(['user_id' => $userId, 'name' => $name]);
    }
}
