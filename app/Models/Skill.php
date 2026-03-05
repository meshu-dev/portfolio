<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasUuids;

    protected $table = 'skills';

    protected $fillable = ['user_id', 'name'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<Technology, $this>
     */
    public function technologies(): BelongsToMany
    {
        return $this->belongsToMany(Technology::class, 'skill_technologies', 'skill_id', 'technology_id');
    }
}
