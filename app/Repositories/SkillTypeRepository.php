<?php

namespace App\Repositories;

use App\Models\SkillType;

class SkillTypeRepository
{
    public function getAll()
    {
        return SkillType::with('skills')->get();
    }

    public function getAllPublic()
    {
        return SkillType::with(['skills'])->public()->get();
    }
}
