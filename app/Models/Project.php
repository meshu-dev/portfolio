<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Project extends Model
{
    use HasUuids;

    protected $table = 'projects';

    protected $fillable = ['user_id', 'name', 'description', 'url'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<Repository, $this>
     */
    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class, 'project_repositories', 'project_id', 'repository_id');
    }

    /**
     * @return BelongsToMany<Technology, $this>
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technologies', 'project_id', 'technology_id');
    }

    /**
     * @return BelongsToMany<File, $this>
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'project_files', 'project_id', 'file_id');
    }

    /**
     * @return HasOneThrough<File, ProjectFile, $this>
     */
    public function image(): HasOneThrough
    {
        return $this->hasOneThrough(File::class, ProjectFile::class, 'project_id', 'id', 'id', 'file_id');
    }
}
