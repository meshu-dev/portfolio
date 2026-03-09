<?php

namespace App\Models;

use Database\Factories\AboutFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    /** @use HasFactory<AboutFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'abouts';

    protected $fillable = ['user_id', 'text'];

    public $timestamps = false;
}
