<?php

namespace App\Http\Controllers\Portfolio;

use App\Actions\Portfolio\Project\GetProjectAction;
use App\Actions\Portfolio\Project\GetProjectsAction;
use App\Http\Controllers\Controller;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class ProjectController extends Controller
{
    public function list(): Response
    {
        $projects = resolve(ProjectRepository::class)->getAll((int) Auth::id());
        return Inertia::render('Portfolio/Projects', ['projects' => $projects]);
    }

    public function view(string $id): Response
    {
        $project = resolve(GetProjectAction::class)->execute((int) Auth::id(), $id);
        return Inertia::render('Portfolio/Project', ['project' => $project]);
    }
}
