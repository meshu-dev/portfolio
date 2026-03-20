<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = ['id', 'name'];

    public $timestamps = false;

    /**
     * @return HasMany<Site, $this>
     */
    public function sites(int $userId): HasMany
    {
        return $this->hasMany(Site::class)->where('user_id', $userId);
    }
}
