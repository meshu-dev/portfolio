<?php

namespace App\Http\Controllers\Portfolio;

use App\Actions\Portfolio\Repository\{CreateRepositoryAction, DeleteRepositoryAction, GetRepositoriesAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\RepositoryRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class RepositoryController extends Controller
{
    public function list(): Response
    {
        $repositories = resolve(GetRepositoriesAction::class)->execute((int) Auth::id());
        return Inertia::render('Portfolio/Repositories', ['repositories' => $repositories]);
    }

    public function add(RepositoryRequest $request): RedirectResponse
    {
        resolve(CreateRepositoryAction::class)->execute(
            $request->input('name'),
            $request->input('url')
        );

        Inertia::flash([
            'message' => 'Repository has been added',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('repositories.view');
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteRepositoryAction::class)->execute($id);

        Inertia::flash([
            'message' => 'Repository has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('repositories.view');
    }
}
