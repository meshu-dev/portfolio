<?php

namespace App\Models;

use Database\Factories\TechnologyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Technology extends Model
{
    /** @use HasFactory<TechnologyFactory> */
    use HasFactory;

    protected $table = 'technologies';

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * The skills that belong to the skill type.
     *
     * @return HasOne<TechnologyBadge, $this>
     */
    public function badge(): HasOne
    {
        return $this->hasOne(TechnologyBadge::class);
    }
}
