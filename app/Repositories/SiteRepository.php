<?php

namespace App\Repositories;

use App\Models\Site;

class SiteRepository
{
    public function getAll()
    {
        return Site::get();
    }
}
