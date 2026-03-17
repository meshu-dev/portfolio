<?php

namespace App\Http\Controllers\Admin\Cv;

use App\Actions\Cv\Skill\{GetSkillsAction, UpdateSkillTechnologiesAction};
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cv\SkillRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class SkillController extends Controller
{
    public function view(): Response
    {
        $skills = resolve(GetSkillsAction::class)->execute((int) Auth::id());
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();

        return Inertia::render(
            'Cv/Skills',
            [
                'skills'       => $skills,
                'technologies' => $technologies
            ]
        );
    }

    public function edit(SkillRequest $request): RedirectResponse
    {
        resolve(UpdateSkillTechnologiesAction::class)->execute($request->input('skills'));

        Inertia::flash([
            'message' => 'Skills have been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('skills.view');
    }
}
