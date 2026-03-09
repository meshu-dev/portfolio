<?php

namespace App\Actions\Portfolio\Intro;

use App\Models\Intro;
use Illuminate\Support\Facades\Auth;

class UpdateIntroAction
{
    /**
     * @param string $line1
     * @param string $line2
     */
    public function execute(string $line1, string $line2): void
    {
        Intro::where('user_id', (int) Auth::id())
                ->update([
                    'line1' => $line1,
                    'line2' => $line2
                ]);
        
        
    }
}
