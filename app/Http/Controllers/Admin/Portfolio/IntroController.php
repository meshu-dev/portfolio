<?php

namespace App\Http\Controllers\Admin\Portfolio;

use App\Actions\Portfolio\Intro\{GetIntroAction, UpdateIntroAction};
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Portfolio\IntroRequest;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class IntroController extends Controller
{
    public function view(): Response
    {
        $intro  = resolve(GetIntroAction::class)->execute((int) Auth::id());
        $params = ['line1' => $intro['line1'], 'line2' => $intro['line2']];

        return Inertia::render('Portfolio/Intro', $params);
    }

    public function edit(IntroRequest $request): RedirectResponse
    {
        resolve(UpdateIntroAction::class)->execute(
            $request->input('line1'),
            $request->input('line2')
        );

        Inertia::flash([
            'message' => 'Intro has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('intro.view');
    }
}
