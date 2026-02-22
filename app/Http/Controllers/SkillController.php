<?php

namespace App\Http\Controllers;

use App\Actions\Cv\Skill\GetSkillsAction;
use App\Actions\Profile\EditProfileAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\{Inertia, Response};

class SkillController extends Controller
{
    public function view(): Response
    {
        $skills = resolve(GetSkillsAction::class)->execute();
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();

        return Inertia::render('Skills', ['skills' => $skills, 'technologies' => $technologies]);
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
}
