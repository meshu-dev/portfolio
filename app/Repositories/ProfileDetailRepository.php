<?php

namespace App\Repositories;

use App\Models\ProfileDetail;

class ProfileDetailRepository
{
    public function getAll()
    {
        return ProfileDetail::get();
    }
}
