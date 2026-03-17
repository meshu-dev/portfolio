<?php

namespace App\Http\Controllers\Admin\Cv;

use App\Actions\Cv\Profile\{GetProfileAction, UpdateProfileAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cv\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends Controller
{
    public function view(): Response
    {
        $profile = resolve(GetProfileAction::class)->execute((int) Auth::id());
        $params  = ['intro' => $profile->intro, 'location' => $profile->location];

        return Inertia::render('Cv/Profile', $params);
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
