<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Repository extends Model
{
    use HasUuids;

    protected $table = 'repositories';

    protected $fillable = ['user_id', 'name', 'url'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<Project, $this>
     */
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_repositories', 'repository_id', 'project_id');
    }
}
