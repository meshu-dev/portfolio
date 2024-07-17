<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Icon extends Model
{
    protected $table = 'icons';

    protected $fillable = ['name', 'url'];

    protected $hidden = ['id'];

    public $timestamps = false;

    public function files()
    {
        return $this->belongsToMany(File::class, 'icon_files', 'icon_id', 'file_id');
    }
}
