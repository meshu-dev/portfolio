<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $table = 'work_experiences';

    protected $fillable = ['title', 'location', 'start_date', 'end_date', 'description', 'responsibilities', 'active'];

    protected $casts = ['responsibilities' => 'array'];

    public $timestamps = false;
}
