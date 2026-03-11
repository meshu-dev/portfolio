<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class DeleteSiteAction
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        return Site::where('user_id', Auth::id())
                   ->where('id', $id)
                   ->delete();
    }
}
