<?php

namespace App\Actions\Cv;

use App\Actions\Cv\{
    Profile\GetProfileAction,
    Skill\GetSkillsAction,
    WorkExperience\GetWorkExperiencesAction,
    Pdf\GetPdfFileUrlAction,
};

class GetCvAction
{
    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $profile         = resolve(GetProfileAction::class)->execute($userId);
        $skills          = resolve(GetSkillsAction::class)->execute($userId);
        $workExperiences = resolve(GetWorkExperiencesAction::class)->execute($userId, true);
        $pdfUrl          = resolve(GetPdfFileUrlAction::class)->execute();

        return [
            'profile'         => $profile,
            'skills'          => $skills,
            'workExperiences' => $workExperiences,
            'pdfUrl'          => $pdfUrl,
        ];
    }
}
