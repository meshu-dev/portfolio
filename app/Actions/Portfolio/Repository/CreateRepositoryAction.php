<?php

namespace App\Actions\Portfolio\Repository;

use App\Models\Repository;
use Illuminate\Support\Facades\Auth;

class CreateRepositoryAction
{
    /**
     * @param string $name
     */
    public function execute(string $name, string $url): void
    {
        Repository::create(['user_id' => Auth::id(), 'name' => $name, 'url' => $url]);
    }
}
