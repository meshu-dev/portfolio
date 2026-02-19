<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

class DeleteTechnologyAction
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        return Technology::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->delete();
    }
}
