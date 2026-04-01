<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $data = require('data/user_data.php');

        $this->call([
            UserSeeder::class,
            TypeSeeder::class,
        ]);

        $params = ['users' => User::all()];

        $this->call(SiteSeeder::class,       parameters: $params);
        $this->call(TechnologySeeder::class, parameters: $params);
        $this->call(CvSeeder::class,         parameters: $params);
        $this->call(PortfolioSeeder::class,  parameters: $params);
    }
}
