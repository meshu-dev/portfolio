<?php

namespace Database\Seeders;

use App\Enums\TypeEnum;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        Type::insert([
            [
                'id'   => TypeEnum::CV->value,
                'name' => 'CV',
                'url'  => 'https://cv.meshpro.io',
            ],
            [
                'id'   => TypeEnum::PORTFOLIO->value,
                'name' => 'Portfolio',
                'url'  => 'https://meshpro.io',
            ]
        ]);
    }
}
