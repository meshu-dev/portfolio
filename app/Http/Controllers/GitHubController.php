<?php

namespace App\Http\Controllers;

use App\Actions\GitHub\GetProfileAction;

class GitHubController extends Controller
{
    /**
     * Get text for portfolio introduction page.
     */
    public function getProfile(GetProfileAction $getProfileAction)
    {
        $data = $getProfileAction->execute();
        return view('github-profile', $data);
    }
}
