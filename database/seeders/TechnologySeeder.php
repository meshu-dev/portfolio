<?php

namespace Database\Seeders;

use App\Models\{Technology, User};
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    public function run(): void
    {
        $users        = User::all();
        $technologies = $this->getTechnologyData();

        foreach ($users as $user) {
            foreach ($technologies as $technology) {
                $technology['user_id'] = $user->id;
                Technology::create($technology);
            }
        }
    }

    private function getTechnologyData(): array
    {
        return [
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
            ['name' => 'Nuxt'],
            ['name' => 'GraphQL'],
            ['name' => 'Linux'],
            ['name' => 'TailwindCSS'],
            ['name' => 'Astro'],
            ['name' => '.NET']
        ];
    }
}
