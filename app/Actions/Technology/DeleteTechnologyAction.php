<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

class DeleteTechnologyAction
{
    /**
     * @param int $id
     * @return bool
     */
    public function execute(int $id): bool
    {
        return Technology::where('user_id', Auth::id())
                         ->where('id', $id)
                         ->delete();
    }
}
