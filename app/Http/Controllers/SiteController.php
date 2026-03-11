<?php

namespace App\Http\Controllers;

use App\Actions\Site\{DeleteSiteAction, GetAllSitesAction, GetSiteAction, UpsertSiteAction};
use App\Enums\FlashTypeEnum;
use App\Http\Requests\SiteRequest;
use Inertia\{Inertia, Response};
use Symfony\Component\HttpFoundation\RedirectResponse;

class SiteController extends Controller
{
    public function list(): Response
    {
        $sites = resolve(GetAllSitesAction::class)->execute();
        return Inertia::render('Site/Sites', ['sites' => $sites]);
    }

    public function view(string $id): Response
    {
        $site = resolve(GetSiteAction::class)->execute($id);
        return Inertia::render('Site/Site', ['site' => $site]);
    }

    public function add(SiteRequest $request): RedirectResponse
    {
        resolve(UpsertSiteAction::class)->execute($request->all());

        Inertia::flash([
            'message' => 'Site has been added',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('sites.list');
    }

    public function edit(SiteRequest $request, string $id): RedirectResponse
    {
        $request->merge(['id' => $id]);
        resolve(UpsertSiteAction::class)->execute($request->all());

        Inertia::flash([
            'message' => 'Site has been updated',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('sites.list');
    }

    public function delete(string $id): RedirectResponse
    {
        resolve(DeleteSiteAction::class)->execute($id);

        Inertia::flash([
            'message' => 'Site has been deleted',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('sites.list');
    }
}
