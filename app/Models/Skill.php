<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = ['name'];

    protected $hidden = ['id'];

    public $timestamps = false;

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'skill_technologies', 'skill_id', 'technology_id');
    }
}
