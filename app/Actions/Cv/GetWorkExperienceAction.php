<?php

namespace App\Actions\Cv;

use App\Models\WorkExperience;

class GetWorkExperienceAction
{
    /**
     * @return WorkExperience
     */
    public function execute(int $id): WorkExperience
    {
        return WorkExperience::find($id);
    }
}
