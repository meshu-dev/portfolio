<?php

namespace App\Actions\Cv;

use App\Repositories\WorkExperienceRepository;

class UpdateWorkExperienceAction
{
    public function __construct(
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    /**
     * @param string $intro
     * @param string $location
     */
    public function execute(int $id, array $params): void
    {
        if (isset($params['is_current'])) {
            if ($params['is_current'] == true) {
                $params['end_date'] = null;
            }
            unset($params['is_current']);
        }

        $this->workExperienceRepository->update($id, $params);
    }
}
