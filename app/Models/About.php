<?php

namespace App\Models;

use App\Enums\SkillEnum;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class About extends Model
{
    use HasUuids;

    protected $table = 'abouts';

    protected $fillable = ['user_id', 'file_id', 'text'];

    public $timestamps = false;

    /**
     * @return HasOne<File, $this>
     */
    public function image(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'file_id');
    }

    /**
     * @return HasOne<Skill, $this>
     */
    public function skill(): HasOne
    {
        return $this->hasOne(Skill::class, 'user_id', 'user_id')->where('name', SkillEnum::PORTFOLIO);
    }
}
