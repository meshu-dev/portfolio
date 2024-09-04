<?php

namespace App\Repositories;

use App\Models\WorkExperience;

class WorkExperienceRepository
{
    public function getAllActive()
    {
        return WorkExperience::where('active', true)->get();
    }
}
