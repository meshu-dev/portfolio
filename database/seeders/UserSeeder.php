<?php

namespace Database\Seeders;

use App\Enums\UserEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = $this->getUsers();

        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }

    private function getUsers(): array
    {
        return [
            [
                'id'       => UserEnum::ADMIN,
                'name'     => config('users.main.name'),
                'email'    => config('users.main.email'),
                'password' => Hash::make(config('users.main.password')),
            ],
            [
                'id'       => UserEnum::DEMO,
                'name'     => config('users.demo.name'),
                'email'    => config('users.demo.email'),
                'password' => Hash::make(config('users.demo.password')),
            ]
        ];
    }
}
