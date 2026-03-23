<?php

namespace App\Actions\Cv\Pdf;

use App\Actions\Cv\GetCvAction;

class GetPdfAction
{
    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $data = resolve(GetCvAction::class)->execute($userId);
        $data['profile'] = resolve(GetProfileForPdfAction::class)->execute($userId);

        return $data;
    }
}
