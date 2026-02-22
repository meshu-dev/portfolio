<?php

namespace App\Http\Controllers;

use App\Actions\Cv\Profile\GetProfileAction;
use App\Actions\Profile\EditProfileAction;
use App\Enums\FlashTypeEnum;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        Log::info('Bing!');

        resolve(EditProfileAction::class)->execute($request->all());

        return Inertia::flash([
            'message' => 'Profile has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ])->back();
    }
}
