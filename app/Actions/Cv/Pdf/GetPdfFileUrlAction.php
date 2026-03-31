<?php

namespace App\Actions\Cv\Pdf;

use App\Actions\File\GetFileUrlAction;

class GetPdfFileUrlAction
{
    /**
     * @return string|null
     */
    public function execute(): string|null
    {
        $file = resolve(GetPdfFileAction::class)->execute();

        return $file ? resolve(GetFileUrlAction::class)->execute($file) : null;
    }
}
