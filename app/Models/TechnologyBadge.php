<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TechnologyBadge extends Model
{
    protected $table = 'technology_badges';

    protected $fillable = ['technology_id', 'icon', 'icon_colour', 'logo', 'logo_colour'];

    public $timestamps = false;
}
