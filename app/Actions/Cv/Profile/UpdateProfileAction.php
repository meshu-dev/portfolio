<?php

namespace App\Actions\Cv\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class UpdateProfileAction
{
    /**
     * @param string $intro
     * @param string $location
     */
    public function execute(string $intro, string $location): void
    {
        Profile::where('user_id', (int) Auth::id())
                ->update([
                    'intro' => $intro,
                    'location' => $location
                ]);
    }
}
