<?php

namespace App\Repositories;

use App\Models\Icon;

class IconRepository
{
    public function getAll()
    {
        return Icon::get();
    }
}
