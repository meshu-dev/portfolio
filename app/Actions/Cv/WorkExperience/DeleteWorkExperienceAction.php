<?php

namespace App\Actions\Cv\WorkExperience;

use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;

class DeleteWorkExperienceAction
{
    /**
     * @param string $id
     * @return bool
     */
    public function execute(string $id): bool
    {
        return WorkExperience::where('user_id', Auth::id())
                             ->where('id', $id)
                             ->delete();
    }
}
