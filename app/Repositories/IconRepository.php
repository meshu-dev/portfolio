<?php

namespace App\Repositories;

use App\Models\Icon;

class IconRepository
{
    public function getAll()
    {
        return Icon::get();
    }

    public function getAllPublic()
    {
        return Icon::public()->get();
    }
}
