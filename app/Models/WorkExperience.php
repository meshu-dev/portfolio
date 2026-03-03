<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasUuids;

    protected $table = 'work_experiences';

    protected $fillable = [
        'user_id',
        'title',
        'company',
        'location',
        'start_date',
        'end_date',
        'description',
        'responsibilities',
        'active'
    ];

    protected $casts = ['responsibilities' => 'array'];

    public $timestamps = false;

    /**
     * Check if the work experience entry is current employment
     * 
     * @return Attribute<string, never>
     */
    protected function isCurrent(): Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes): bool {
                $workExpierence = WorkExperience::select('id')->orderByDesc('start_date')->first();
                return $workExpierence?->id === $attributes['id'];
            },
        );
    }
}
