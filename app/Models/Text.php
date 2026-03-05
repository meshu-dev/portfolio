<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasUuids;

    protected $table = 'texts';

    protected $fillable = ['user_id', 'name', 'value'];

    public $timestamps = false;
}
