<?php

namespace App\Actions\Portfolio;

use App\Http\Resources\ProjectResource;
use App\Repositories\ProjectRepository;
use App\Models\Project;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetProjectsAction
{
    public function __construct(
        protected ProjectRepository $projectRepository
    ) {
    }

    /**
     * @return array<string, AnonymousResourceCollection<int, Project>>
     */
    public function execute(): array
    {
        return [
            'projects' => ProjectResource::collection($this->projectRepository->getAll())
        ];
    }
}
