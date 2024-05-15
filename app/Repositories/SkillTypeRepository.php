<?php

namespace App\Repositories;

use App\Models\SkillType;

class SkillTypeRepository
{
    public function getAll()
    {
        return SkillType::with('skills')->get();
    }
}
