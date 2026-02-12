<?php

namespace Database\Seeders;

use App\Models\{Technology, TechnologyBadge};
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $technologies = [
            [
                'name'  => 'PHP',
                'badge' => [
                    'icon'        => 'php',
                    'icon_colour' => '#777BB4',
                    'logo'        => 'php',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name' => 'Java',
                'badge' => [
                    'icon'        => 'java',
                    'icon_colour' => '#ED8B00',
                    'logo'        => 'java',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name' => 'Backbone.js'
            ],
            [
                'name' => 'jQuery'
            ],
            [
                'name' => 'Sass'
            ],
            [
                'name' => 'Symfony',
                'badge' => [
                    'icon'        => 'symfony',
                    'icon_colour' => 'black',
                    'logo'        => 'symfony',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name' => 'Amazon AWS',
                'badge' => [
                    'icon'        => 'amazon',
                    'icon_colour' => 'FF9900',
                    'logo'        => 'amazon',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name' => 'Docker',
                'badge' => [
                    'icon'        => 'docker',
                    'icon_colour' => '2496ED',
                    'logo'        => 'docker',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name' => 'PHPUnit',
                'badge' => [
                    'icon'        => 'phpunit',
                    'icon_colour' => '777BB4',
                    'logo'        => 'php',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name' => 'Objective-C'
            ],
            [
                'name'  => 'C#',
                'badge' => [
                    'icon'        => 'c#',
                    'icon_colour' => '#239120',
                    'logo'        => 'c-sharp',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name' => 'Laravel',
                'badge' => [
                    'icon'        => 'laravel',
                    'icon_colour' => '#FF2D20',
                    'logo'        => 'laravel',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name' => 'Wordpress',
                'badge' => [
                    'icon'        => 'wordpress',
                    'icon_colour' => '21759B',
                    'logo'        => 'wordpress',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'Node.js',
                'badge' => [
                    'icon'        => 'node.js',
                    'icon_colour' => '#6DA55F',
                    'logo'        => 'node.js',
                    'logo_colour' => 'white'
                ],
            ],
            [
                'name'  => 'MySQL',
                'badge' => [
                    'icon'        => 'mysql',
                    'icon_colour' => '#00f',
                    'logo'        => 'mysql',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'MongoDB',
                'badge' => [
                    'icon'        => 'MongoDB',
                    'icon_colour' => '#4ea94b',
                    'logo'        => 'mongodb',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'PostgreSQL',
                'badge' => [
                    'icon'        => 'postgres',
                    'icon_colour' => '#316192',
                    'logo'        => 'postgresql',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'Express.js',
                'badge' => [
                    'icon'        => 'express.js',
                    'icon_colour' => '#404d59',
                    'logo'        => 'express',
                    'logo_colour'  => '#61DAFB'
                ],
            ],
            [
                'name'  => 'Fastify',
                'badge' => [
                    'icon'        => 'fastify',
                    'icon_colour' => 'black',
                    'logo'        => 'fastify',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'Angular',
                'badge' => [
                    'icon'        => 'angular',
                    'icon_colour' => '#DD0031',
                    'logo'        => 'angular',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'React',
                'badge' => [
                    'icon'        => 'react',
                    'icon_colour' => '#20232a',
                    'logo'        => 'react',
                    'logo_colour'  => '#61DAFB'
                ],
            ],
            [
                'name'  => 'Next.js',
                'badge' => [
                    'icon'        => 'Next',
                    'icon_colour' => 'black',
                    'logo'        => 'next.js',
                    'logo_colour'  => 'white'
                ],
            ],
            [
                'name'  => 'Vue.js',
                'badge' => [
                    'icon'        => 'vuejs',
                    'icon_colour' => '#35495e',
                    'logo'        => 'vuedotjs',
                    'logo_colour'  => '#4FC08D'
                ],
            ],
            [
                'name'  => 'Nuxt',
                'badge' => [
                    'icon'        => 'Nuxt',
                    'icon_colour' => '002E3B',
                    'logo'        => 'nuxtdotjs',
                    'logo_colour'  => '#00DC82'
                ],
            ],
            [
                'name' => 'GraphQL'
            ],
            [
                'name' => 'Linux',
                'badge' => [
                    'icon'        => 'Nuxt',
                    'icon_colour' => '002E3B',
                    'logo'        => 'nuxtdotjs',
                    'logo_colour'  => 'black'
                ],
            ],
            [
                'name' => 'TailwindCSS',
                'badge' => [
                    'icon'        => 'linux',
                    'icon_colour' => 'FCC624',
                    'logo'        => 'linux',
                    'logo_colour'  => 'black'
                ],
            ],
            [
                'name' => 'Astro'
            ],
            [
                'name'  => '.NET',
                'badge' => [
                    'icon'        => '.NET',
                    'icon_colour' => '5C2D91',
                    'logo'        => '.net',
                    'logo_colour'  => 'white'
                ],
            ]
        ];

        foreach ($technologies as $technology) {
            $this->addTechnology($technology);
        }
    }

    protected function addTechnology(array $params)
    {
        $technology  = Technology::create(['name' => $params['name']]);
        $badgeParams = $params['badge'] ?? null;

        if ($badgeParams) {
            $badgeParams['technology_id'] = $technology->id;
            TechnologyBadge::insert($badgeParams);
        }
    }
}
