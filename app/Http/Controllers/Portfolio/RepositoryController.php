<?php

namespace App\Http\Controllers\Portfolio;

use App\Actions\Portfolio\Repository\GetRepositoriesAction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\{Inertia, Response};

class RepositoryController extends Controller
{
    public function list(): Response
    {
        $repositories = resolve(GetRepositoriesAction::class)->execute((int) Auth::id());
        return Inertia::render('Portfolio/Repositories', ['repositories' => $repositories]);
    }
}
