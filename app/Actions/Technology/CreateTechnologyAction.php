<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

class CreateTechnologyAction
{
    /**
     * @param string $name
     */
    public function execute(string $name): void
    {
        Technology::create(['user_id' => Auth::id(), 'name' => $name]);
    }
}
