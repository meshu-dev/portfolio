<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologyGroup extends Model
{
    protected $table = 'technology_groups';

    protected $fillable = ['name'];

    public $timestamps = false;
}
