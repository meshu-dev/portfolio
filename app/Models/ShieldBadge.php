<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologyBadge extends Model
{
    protected $table = 'technology_badges';

    protected $fillable = ['name'];

    public $timestamps = false;
}
