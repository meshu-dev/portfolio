<?php

namespace App\Actions\File;

use App\Enums\FileEnum;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class GetPdfFileUrlAction
{
    /**
     * @return string
     */
    public function execute(): string
    {
        $file = File::where('user_id', Auth::id())
                    ->where('name', FileEnum::PDF->value)
                    ->firstOrFail();

        return resolve(GetFileUrlAction::class)->execute($file);
    }
}
