<?php

namespace App\Actions\Portfolio\Intro;

use App\Models\Intro;

class GetIntroAction
{
    /**
     * @return Intro
     */
    public function execute(int $userId): Intro
    {
        return Intro::where('user_id', $userId)->firstOrFail();
    }
}
