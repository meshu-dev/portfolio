<?php

namespace App\Http\Controllers;

use App\Actions\Cv\Skill\GetSkillsAction;
use App\Actions\Cv\Skill\UpdateSkillTechnologiesAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\SkillRequest;
use App\Http\Resources\SkillResource;
use Illuminate\Http\RedirectResponse;
use Inertia\{Inertia, Response};

class SkillController extends Controller
{
    public function view(): Response
    {
        $skills = resolve(GetSkillsAction::class)->execute();
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();

        return Inertia::render(
            'Skills',
            [
                'skills'       => $skills,
                'technologies' => $technologies
            ]    
        );
    }

    public function edit(SkillRequest $request): RedirectResponse
    {
        resolve(UpdateSkillTechnologiesAction::class)->execute($request->input('skills'));

        return Inertia::flash([
            'message' => 'Skills have been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }
}
