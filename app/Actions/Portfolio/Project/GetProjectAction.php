<?php

namespace App\Actions\Portfolio\Project;

use App\Repositories\ProjectRepository;
use App\Models\Project;

class GetProjectAction
{
    public function __construct(
        protected ProjectRepository $projectRepository
    ) {
    }

    /**
     * @param int $userId
     * @param string $projectId
     * @return Project
     */
    public function execute(int $userId, string $projectId): Project
    {
        return $this->projectRepository->get($userId, $projectId);
    }
}
