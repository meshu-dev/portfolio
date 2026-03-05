<?php

namespace App\Actions\Portfolio\Repository;

use App\Models\Repository;
use Illuminate\Support\Facades\Auth;

class DeleteRepositoryAction
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        return Repository::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->delete();
    }
}
