<?php

namespace App\Models;

use Database\Factories\TechnologyFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    /** @use HasFactory<TechnologyFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'technologies';

    protected $fillable = ['user_id', 'name'];

    public $timestamps = false;
}
