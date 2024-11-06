<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'projects';

    protected $fillable = ['name', 'description', 'url'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<Repository>
     */
    public function repositories(): BelongsToMany
    {
        return $this->belongsToMany(Repository::class, 'project_repositories', 'project_id', 'repository_id');
    }

    /**
     * @return BelongsToMany<Technology>
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'project_technologies', 'project_id', 'technology_id');
    }

    /**
     * @return BelongsToMany<File>
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'project_files', 'project_id', 'file_id');
    }
}
