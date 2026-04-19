<?php

namespace App\Actions\Type;

use App\Models\Type;

class GetTypeByUrlAction
{
    public function execute(string $url): Type
    {
        $url = rtrim($url, '/');
        return Type::where('url', $url)->firstOrFail();
    }
}
