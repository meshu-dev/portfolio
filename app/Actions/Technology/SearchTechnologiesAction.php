<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class SearchTechnologiesAction
{
    /**
     * @param string $search
     * @return Collection<int, Technology>
     */
    public function execute(string $search): Collection
    {
        return Technology::where('user_id', Auth::id())
                         ->orderBy('name')
                         ->whereLike('name', "$search%")
                         ->get();
    }
}
