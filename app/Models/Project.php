<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name', 'description', 'url'];

    public $timestamps = false;

    public function repositories()
    {
        return $this->belongsToMany(Repository::class, 'project_repositories', 'project_id', 'repository_id');
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'project_technologies', 'project_id', 'technology_id');
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'project_files', 'project_id', 'file_id');
    }
}
