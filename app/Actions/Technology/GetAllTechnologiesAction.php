<?php

namespace App\Actions\Technology;

use App\Models\Technology;
use Illuminate\Support\Collection;

class GetAllTechnologiesAction
{
    /**
     * @return Collection<int, Technology>
     */
    public function execute(): Collection
    {
        return Technology::orderBy('name')->get();
    }
}
