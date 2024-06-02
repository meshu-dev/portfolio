<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository
{
    public function getAll()
    {
        return Skill::with('technologies')->get();
    }

    public function getAllPublic()
    {
        return Skill::with(['technologies'])->public()->get();
    }
}
