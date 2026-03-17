<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Technology\{CreateTechnologyAction, DeleteTechnologyAction, GetAllTechnologiesAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\TechnologyRequest;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class TechnologyController extends Controller
{
    public function view(): Response
    {
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();
        return Inertia::render('Technologies', ['technologies' => $technologies]);
    }

    public function add(TechnologyRequest $request): RedirectResponse
    {
        resolve(CreateTechnologyAction::class)->execute($request->input('name'));

        Inertia::flash([
            'message' => 'Technology has been added',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('technologies.view');
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteTechnologyAction::class)->execute($id);

        Inertia::flash([
            'message' => 'Technology has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('technologies.view');
    }
}
