<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['skill_type_id', 'name'];

    protected $hidden = ['id', 'skill_type_id'];

    public $timestamps = false;
}
