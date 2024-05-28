<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillType extends Model
{
    protected $table = 'skill_types';

    protected $fillable = ['name'];

    protected $hidden = ['id'];

    public $timestamps = false;

    /**
     * The skills that belong to the skill type.
     */
    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class);
    }
}
