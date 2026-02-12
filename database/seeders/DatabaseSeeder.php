<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            TypeSeeder::class,
            SiteSeeder::class,
            TechnologySeeder::class,
            CvSeeder::class,
            PortfolioSeeder::class,
        ]);
    }
}
