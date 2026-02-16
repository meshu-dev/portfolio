<?php

namespace App\Actions\Cv\WorkExperience;

use App\Models\WorkExperience;
use Illuminate\Support\Facades\Auth;

class GetWorkExperienceAction
{
    /**
     * @return WorkExperience
     */
    public function execute(int $id): WorkExperience
    {
        return WorkExperience::where('user_id', Auth::id())->where('id', $id);
    }
}
