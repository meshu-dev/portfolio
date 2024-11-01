<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = ['name', 'description', 'url'];

    public $timestamps = false;

    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class, 'project_repositories', 'project_id', 'repository_id');
    }

    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technologies', 'project_id', 'technology_id');
    }

    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'project_files', 'project_id', 'file_id');
    }
}
