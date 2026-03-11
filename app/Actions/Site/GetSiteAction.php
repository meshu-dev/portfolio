<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Facades\Auth;

class GetSiteAction
{
    /**
     * @return Collection<int, Site>
     */
    public function execute(string $id): Site
    {
        return Site::where('user_id', (int) Auth::id())
                   ->where('id', $id)
                   ->firstOrFail();
    }
}
