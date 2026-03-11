<?php

namespace App\Actions\Portfolio\About;

use App\Models\About;

class GetAboutAction
{
    /**
     * @return About
     */
    public function execute(int $userId): About
    {
        return About::where('user_id', $userId)->firstOrFail();
    }
}
