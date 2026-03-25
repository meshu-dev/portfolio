<?php

namespace App\Actions\Portfolio\Repository;

use App\Exceptions\RepositoryInUseException;
use App\Models\Repository;
use Illuminate\Support\Facades\Auth;

class DeleteRepositoryAction
{
    /**
     * @param string $id
     * @return bool|null
     */
    public function execute(string $id): bool|null
    {
        $repository = Repository::where('user_id', Auth::id())
                                ->where('id', $id)
                                ->firstOrFail();

        $totalProjects = $repository->projects->count();

        throw_if(
            $totalProjects,
            RepositoryInUseException::class,
            "Repository is used in $totalProjects project/s"
        );

        return $repository->delete();
    }
}
