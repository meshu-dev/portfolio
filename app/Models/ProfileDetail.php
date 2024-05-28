<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileDetail extends Model
{
    protected $table = 'profile_details';

    protected $fillable = ['key', 'value'];

    protected $hidden = ['id'];

    public $timestamps = false;
}
