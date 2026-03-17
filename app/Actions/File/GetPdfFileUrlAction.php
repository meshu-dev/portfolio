<?php

namespace App\Actions\File;

use App\Enums\FileEnum;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class GetPdfFileUrlAction
{
    /**
     * @return string|null
     */
    public function execute(): string|null
    {
        $file = File::where('user_id', Auth::id())
                    ->where('name', FileEnum::PDF->value)
                    ->first();

        return $file ? resolve(GetFileUrlAction::class)->execute($file) : null;
    }
}
