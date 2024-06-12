<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $table = 'texts';

    protected $fillable = ['name', 'value'];

    protected $hidden = ['id'];

    public $timestamps = false;
}
