<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Technology::insert([
            ['name' => 'PHP'],
            ['name' => 'Java'],
            ['name' => 'Backbone.js'],
            ['name' => 'jQuery'],
            ['name' => 'Sass'],
            ['name' => 'Symfony'],
            ['name' => 'Amazon AWS'],
            ['name' => 'Docker'],
            ['name' => 'PHPUnit'],
            ['name' => 'Objective-C'],
            ['name' => 'C#'],
            ['name' => 'Laravel'],
            ['name' => 'Wordpress'],
            ['name' => 'Node.js'],
            ['name' => 'MySQL'],
            ['name' => 'MongoDB'],
            ['name' => 'PostgreSQL'],
            ['name' => 'Express.js'],
            ['name' => 'Fastify'],
            ['name' => 'Angular'],
            ['name' => 'React'],
            ['name' => 'Next.js'],
            ['name' => 'Vue.js'],
            ['name' => 'Nuxt.js'],
            ['name' => 'GraphQL'],
            ['name' => 'Linux'],
            ['name' => 'TailwindCSS'],
            ['name' => 'Astro']
        ]);
    }
}
