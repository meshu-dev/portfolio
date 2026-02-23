<?php

namespace App\Http\Controllers;

use App\Actions\Cv\Profile\GetProfileAction;
use App\Actions\Cv\Profile\UpdateProfileAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\{Inertia, Response};

class ProfileController extends Controller
{
    public function view(): Response
    {
        $profile = resolve(GetProfileAction::class)->execute();
        $params  = ['intro' => $profile->get('intro'), 'location' => $profile->get('location')];

        return Inertia::render('Profile', $params);
    }

    public function edit(ProfileRequest $request): RedirectResponse
    {
        resolve(UpdateProfileAction::class)->execute(
            $request->input('intro'),
            $request->input('location')
        );

        return Inertia::flash([
            'message' => 'Profile has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }
}
