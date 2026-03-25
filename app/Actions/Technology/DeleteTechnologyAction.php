<?php

namespace App\Actions\Technology;

use App\Exceptions\TechnologyInUseException;
use App\Models\Technology;
use Illuminate\Support\Facades\Auth;

class DeleteTechnologyAction
{
    /**
     * @param string $id
     * @return bool|null
     */
    public function execute(string $id): bool|null
    {
        $technology = Technology::where('user_id', Auth::id())
                                ->where('id', $id)
                                ->firstOrFail();

        $totalSkills   = $technology->skills->count();
        $totalProjects = $technology->projects->count();

        throw_if(
            $totalSkills,
            TechnologyInUseException::class,
            "Technology is used in $totalSkills skill/s"
        );

        throw_if(
            $totalProjects,
            TechnologyInUseException::class,
            "Technology is used in $totalProjects project/s"
        );

        return $technology->delete();
    }
}
