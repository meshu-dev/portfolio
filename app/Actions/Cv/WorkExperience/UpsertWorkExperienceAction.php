<?php

namespace App\Actions\Cv\WorkExperience;

use App\Repositories\WorkExperienceRepository;
use Illuminate\Support\Facades\Auth;

class UpsertWorkExperienceAction
{
    public function __construct(
        protected WorkExperienceRepository $workExperienceRepository
    ) {
    }

    /**
     * @param array<string, mixed> params
     */
    public function execute(array $params): void
    {
        if (isset($params['is_current'])) {
            if ($params['is_current'] == true) {
                $params['end_date'] = null;
            }
            unset($params['is_current']);
        }
        
        if (!empty($params['id'])) {
            $id = $params['id'];
            unset($params['id']);

            $this->workExperienceRepository->update(Auth::id(), $id, $params);
        } else {
            $params['user_id'] = Auth::id();
            $this->workExperienceRepository->create($params);
        }
    }
}
