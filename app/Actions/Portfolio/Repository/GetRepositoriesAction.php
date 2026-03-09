<?php

namespace App\Actions\Portfolio\Repository;

use App\Models\Repository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class GetRepositoriesAction
{
    /**
     * @return Collection<int, Repository>
     */
    public function execute(): Collection
    {
        return Repository::where('user_id', (int) Auth::id())->get();
    }
}
