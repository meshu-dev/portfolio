<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['skill_type_id', 'name'];

    public $timestamps = false;
}
