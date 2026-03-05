<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Repository extends Model
{
    use HasUuids;

    protected $table = 'repositories';

    protected $fillable = ['user_id', 'name', 'url'];

    public $timestamps = false;
}
