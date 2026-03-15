<?php

namespace App\Libraries;

use Faker\Provider\Base;

class Faker extends Base
{
    private const URL = 'https://placehold.co';

    public function placeholderImageUrl(int $width = 640, int $height = 480): string
    {
        return self::URL . '/' . sprintf('%sx%s', $width, $height);
    }
}
