<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string $project_id
 * @property int $file_id
 */
class ProjectFile extends Pivot
{
    protected $table = 'project_files';
}
