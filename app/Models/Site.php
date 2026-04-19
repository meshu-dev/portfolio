<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Site extends Model
{
    use HasUuids;

    protected $table = 'sites';

    protected $fillable = ['user_id', 'name', 'url', 'icon'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<File, $this>
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'site_files', 'site_id', 'file_id');
    }

    /**
     * @return HasOne<File, $this>
     */
    public function image(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    /**
     * @return BelongsToMany<Type, $this>
     */
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'type_sites', 'site_id', 'type_id');
    }
}
