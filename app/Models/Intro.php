<?php

namespace App\Models;

use Database\Factories\IntroFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intro extends Model
{
    /** @use HasFactory<IntroFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'intros';

    protected $fillable = ['user_id', 'line1', 'line2'];

    public $timestamps = false;
}
