<?php

namespace App\Actions\Portfolio\About;

use App\Models\About;
use Illuminate\Support\Facades\Auth;

class UpdateAboutAction
{
    public function execute(string $text): void
    {
        $userId = (int) Auth::id();

        About::where('user_id', $userId)->update(['text' => $text]);
    }
}
