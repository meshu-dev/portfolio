<?php

namespace App\Http\Controllers\Portfolio;

use App\Actions\Portfolio\Project\{DeleteProjectAction, GetProjectAction, UpsertProjectAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\ProjectRequest;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    public function new(): Response
    {
        return Inertia::render('Portfolio/Project');
    }

    public function edit(ProjectRequest $request, string $id): RedirectResponse
    {
        $request->merge(['id' => $id]);
        resolve(UpsertProjectAction::class)->execute($request->all());

        Inertia::flash([
            'message' => 'Project has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('projects.list');
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteProjectAction::class)->execute($id);

        Inertia::flash([
            'message' => 'Project has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('projects.list');
    }
}
