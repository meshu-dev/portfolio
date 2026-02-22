<?php

namespace App\Http\Controllers;

use App\Actions\Cv\WorkExperience\DeleteWorkExperienceAction;
use App\Actions\Cv\WorkExperience\GetWorkExperienceAction;
use App\Actions\Cv\WorkExperience\GetWorkExperiencesAction;
use App\Actions\Cv\WorkExperience\UpsertWorkExperienceAction;
use App\Actions\Profile\EditProfileAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\WorkExperienceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\{Inertia, Response};

class WorkExperienceController extends Controller
{
    public function list(): Response
    {
        $workExperiences = resolve(GetWorkExperiencesAction::class)->execute();
        return Inertia::render('WorkExperiences', ['workExperiences' => $workExperiences]);
    }

    public function view(string $id): Response
    {
        $workExperience = resolve(GetWorkExperienceAction::class)->execute($id);
        return Inertia::render('WorkExperience', ['workExperience' => $workExperience]);
    }

    public function edit(string $id, WorkExperienceRequest $request): RedirectResponse
    {
        $params = $request->all();
        $params['id'] = $id;

        resolve(UpsertWorkExperienceAction::class)->execute($params);

        return Inertia::flash([
            'message' => 'Work experience has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteWorkExperienceAction::class)->execute($id);

        return Inertia::flash([
            'message' => 'Work experience has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }
}
