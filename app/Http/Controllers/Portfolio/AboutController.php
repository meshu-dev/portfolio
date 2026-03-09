<?php

namespace App\Http\Controllers\Portfolio;

use App\Actions\Portfolio\About\{GetAboutAction, UpdateAboutAction};
use App\Actions\Technology\GetAllTechnologiesAction;
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\AboutRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class AboutController extends Controller
{
    public function view(): Response
    {
        $about = resolve(GetAboutAction::class)->execute((int) Auth::id());
        $technologies = resolve(GetAllTechnologiesAction::class)->execute();

        return Inertia::render(
            'Portfolio/About',
            [
                'text'              => $about['text'],
                'skillTechnologies' => $about['skillTechnologies'],
                'technologies'      => $technologies,
            ]
        );
    }

    public function edit(AboutRequest $request): RedirectResponse
    {
        resolve(UpdateAboutAction::class)->execute(
            $request->input('text'),
            $request->input('skills')
        );

        Inertia::flash([
            'message' => 'About has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('about.view');
    }
}
