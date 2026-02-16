<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetAllTechnologiesAction
{
    /**
     * @return Collection<int, Technology>
     */
    public function execute(): Collection
    {
        return Technology::where('user_id', Auth::id())
                         ->orderBy('name')
                         ->get();
    }
}
