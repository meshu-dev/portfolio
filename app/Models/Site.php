<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Site extends Model
{
    protected $table = 'sites';

    protected $fillable = ['name', 'url'];

    public $timestamps = false;

    /**
     * @return BelongsToMany<File>
     */
    public function files(): BelongsToMany
    {
        return $this->belongsToMany(File::class, 'site_files', 'site_id', 'file_id');
    }
}
