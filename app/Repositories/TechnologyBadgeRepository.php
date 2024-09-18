<?php

namespace App\Repositories;

use App\Models\TechnologyBadge;

class TechnologyBadgeRepository
{
    public function getAll()
    {
        return TechnologyBadge::get();
    }
}
