<?php

namespace App\Http\Controllers;

use App\Actions\Cv\Profile\{GetProfileAction, UpdateProfileAction};
use App\Enums\FlashTypeEnum;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends Controller
{
    public function view(): Response
    {
        $profile = resolve(GetProfileAction::class)->execute((int) Auth::id());
        $params  = ['intro' => $profile->get('intro'), 'location' => $profile->get('location')];

        return Inertia::render('Profile', $params);
    }

    public function edit(ProfileRequest $request): RedirectResponse
    {
        resolve(UpdateProfileAction::class)->execute(
            $request->input('intro'),
            $request->input('location')
        );

        Inertia::flash([
            'message' => 'Profile has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('profile.view');
    }
}
