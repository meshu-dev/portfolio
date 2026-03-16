<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetSiteAction
{
    /**
     * @return Site
     */
    public function execute(string $id): Site
    {
        return Site::where('user_id', (int) Auth::id())
                   ->where('id', $id)
                   ->firstOrFail();
    }
}
