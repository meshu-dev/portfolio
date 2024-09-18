<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;

class GetProjectsAction
{
    public function __construct(
        protected ProjectRepository $projectRepository
    ) {
    }

    public function execute(): array
    {
        return [
            'projects' => ProjectResource::collection($this->projectRepository->getAll())
        ];
    }
}
