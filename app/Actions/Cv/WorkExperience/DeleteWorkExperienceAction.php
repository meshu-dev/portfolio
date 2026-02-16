<?php

namespace App\Actions\Cv\WorkExperience;

use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;

class DeleteWorkExperienceAction
{
    /**
     * @return bool
     */
    public function execute(int $id): bool
    {
        return WorkExperience::where('user_id', Auth::id())
                             ->where('id', $id)
                             ->delete();
    }
}
