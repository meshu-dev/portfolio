<?php

namespace Database\Seeders;

use App\Models\{Technology, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class TechnologySeeder extends Seeder
{
    public function run(Collection $users): void
    {
        $data = require('data/user_data.php');
        $technologies = $data['technologies'];

        foreach ($users as $user) {
            foreach ($technologies as $technology) {
                $this->addTechnology($user, $technology);
            }
        }
    }

    protected function addTechnology(User $user, string $technology): void
    {
        $params = [
            'user_id' => $user->id,
            'name' => $technology
        ];
        Technology::create($params);
    }
}
