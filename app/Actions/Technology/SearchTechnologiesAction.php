<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;

class SearchTechnologiesAction
{
    /**
     * @return Collection<int, Technology>
     */
    public function execute(string $search): Collection
    {
        return Technology::orderBy('name')->whereLike('name', "$search%")->get();
    }
}
