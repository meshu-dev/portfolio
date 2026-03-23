<?php

namespace App\Actions\Cv\Pdf;

use App\Actions\Cv\Profile\GetProfileAction;
use App\Actions\Site\GetSitesByTypeAction;
use App\Enums\TypeEnum;
use App\Models\Profile;

class GetProfileForPdfAction
{
    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $profile = resolve(GetProfileAction::class)->execute($userId);
        $sites   = resolve(GetSitesByTypeAction::class)->execute($userId, TypeEnum::CV);

        return [
            'fullname' => $profile->fullname,
            'intro'    => $profile->formattedIntro,
            'location' => $profile->location,
            'sites'    => $sites,
        ];
    }
}
