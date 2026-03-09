<?php

namespace App\Models;

use App\Actions\Portfolio\GetDynamicTextAction;
use Database\Factories\ProfileFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<ProfileFactory> */
    use HasFactory;
    use HasUuids;

    protected $table = 'profiles';

    protected $fillable = ['user_id', 'intro', 'location'];

    public $timestamps = false;

    public function getFormattedIntroAttribute(): string
    {
        return resolve(GetDynamicTextAction::class)->execute($this->intro);
    }
}
