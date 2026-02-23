<?php

namespace App\Http\Controllers;

use App\Actions\Technology\CreateTechnologyAction;
use App\Actions\Technology\DeleteTechnologyAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\TechnologyRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\{Inertia, Response};

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

        return Inertia::flash([
            'message' => 'Technology has been added',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteTechnologyAction::class)->execute($id);

        return Inertia::flash([
            'message' => 'Technology has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }
}
