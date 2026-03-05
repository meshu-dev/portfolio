<?php

namespace App\Actions\Portfolio\Repository;

use App\Models\Repository;
use Illuminate\Support\Collection;

class GetRepositoriesAction
{
    /**
     * @return Collection<int, Repository>
     */
    public function execute(int $userId): Collection
    {
        return Repository::where('user_id', $userId)->get();
    }
}
