<?php

namespace App\Http\Controllers;

use App\Actions\Profile\EditProfileAction;
use App\Actions\Technology\DeleteTechnologyAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\{Inertia, Response};

class TechnologyController extends Controller
{
    public function view(): Response
    {
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();
        return Inertia::render('Technologies', ['technologies' => $technologies]);
    }

    public function edit(ProfileRequest $request): RedirectResponse
    {
        Log::info('Bing!');

        resolve(EditProfileAction::class)->execute($request->all());

        return Inertia::flash([
            'message' => 'Profile has been updated',
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
