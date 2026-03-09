<?php

namespace App\Actions\Cv\Profile;

use App\Models\Profile;

class GetProfileAction
{
    /**
     * @return Profile
     */
    public function execute(int $userId): Profile
    {
        return Profile::where('user_id', $userId)->firstOrFail();
    }
}
