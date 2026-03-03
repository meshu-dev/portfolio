<?php

namespace App\Http\Controllers;

use App\Actions\Technology\CreateTechnologyAction;
use App\Actions\Technology\DeleteTechnologyAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
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
        ])->back();

        return to_route('technologies.view');
    }
}
