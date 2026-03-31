<?php

namespace App\Actions\Cv\Pdf;

use App\Enums\FileEnum;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class GetPdfFileAction
{
    /**
     * @return File|null
     */
    public function execute(): File|null
    {
        return File::where('user_id', Auth::id())
                   ->where('name', FileEnum::PDF->value)
                   ->first();
    }
}
