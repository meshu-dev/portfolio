<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasUuids;

    protected $table = 'texts';

    protected $fillable = ['name', 'value'];

    public $timestamps = false;
}
