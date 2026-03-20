<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Actions\Portfolio\About\{GetAboutAction, UpdateAboutAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\AboutRequest;
use App\Http\Resources\Admin\AboutResource;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class AboutController extends Controller
{
    public function view(): Response
    {
        $about = resolve(GetAboutAction::class)->execute((int) Auth::id());
        return Inertia::render('Portfolio/About', ['about' => resolve(AboutResource::class, ['resource' => $about])]);
    }

    public function edit(AboutRequest $request): RedirectResponse
    {
        $params = $request->all();

        resolve(UpdateAboutAction::class)->execute($params);

        Inertia::flash([
            'message' => 'About has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        $about = resolve(GetAboutAction::class)->execute((int) Auth::id());

        return to_route('about.view', ['about' => $about]);
    }
}
