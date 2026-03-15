<?php

namespace App\Libraries;

use Faker\Provider\Base;

class Faker extends Base
{
    public function placeholderImageUrl(int $width = 640, int $height = 480): string
    {
        return config('app.faker_placeholder_url') . '/' . sprintf('%sx%s', $width, $height);
    }
}
