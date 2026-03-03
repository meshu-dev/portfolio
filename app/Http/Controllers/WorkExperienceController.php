<?php

namespace App\Http\Controllers;

use App\Actions\Cv\WorkExperience\{
    DeleteWorkExperienceAction,
    GetWorkExperienceAction,
    GetWorkExperiencesAction,
    UpsertWorkExperienceAction,
};
use App\Enums\FlashTypeEnum;
use App\Http\Requests\WorkExperienceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class WorkExperienceController extends Controller
{
    public function list(): Response
    {
        $workExperiences = resolve(GetWorkExperiencesAction::class)->execute(Auth::id());
        return Inertia::render('WorkExperiences', ['workExperiences' => $workExperiences]);
    }

    public function new(): Response
    {
        return Inertia::render('WorkExperience');
    }

    public function view(string $id): Response
    {
        $workExperience = resolve(GetWorkExperienceAction::class)->execute($id);
        return Inertia::render('WorkExperience', ['workExperience' => $workExperience]);
    }

    public function add(WorkExperienceRequest $request): RedirectResponse
    {
        resolve(UpsertWorkExperienceAction::class)->execute($request->all());

        Inertia::flash([
            'message' => 'Work experience has been added',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('work-experiences.list');
    }

    public function edit(string $id, WorkExperienceRequest $request): RedirectResponse
    {
        $params = $request->all();
        $params['id'] = $id;

        resolve(UpsertWorkExperienceAction::class)->execute($params);

        Inertia::flash([
            'message' => 'Work experience has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('work-experiences.list');
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteWorkExperienceAction::class)->execute($id);

        Inertia::flash([
            'message' => 'Work experience has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('work-experiences.list');
    }
}
