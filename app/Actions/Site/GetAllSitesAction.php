<?php

namespace App\Actions\Site;

use App\Models\Site;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetAllSitesAction
{
    /**
     * @return Collection<int, Site>
     */
    public function execute(): Collection
    {
        return Site::where('user_id', Auth::id())->get();
    }
}
