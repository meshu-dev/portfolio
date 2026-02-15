<?php

namespace App\Actions\Technology;

use App\Models\Technology;

class CreateTechnologyAction
{
    /**
     * @param string $name
     */
    public function execute(string $name): void
    {
        Technology::create(['name' => $name]);
    }
}
