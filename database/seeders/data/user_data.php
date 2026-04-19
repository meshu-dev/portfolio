<?php

use App\Enums\{DynamicValueEnum, TypeEnum};

return [
    'cv' => [
        'profile' => [
            'fullname'  => 'Joe Blogss',
            'intro'     => "Full-stack developer with over " .
                            DynamicValueEnum::YEARS_WORKED->value .
                            " years experience in PHP and JavaScript",
            'location'  => 'West Midlands, UK',
        ],
        'skills' => [
            [
                'skill'        => ['name' => 'Backend'],
                'technologies' => ['PHP', 'MySQL', 'Node.js', 'Java'],
            ],
            [
                'skill'        => ['name' => 'Frontend'],
                'technologies' => ['Vue.js', 'React', 'Angular', 'TailwindCSS'],
            ],
            [
                'skill'        => ['name' => 'Frameworks'],
                'technologies' => ['Laravel', 'Wordpress', 'Next.js', 'Nuxt'],
            ],
            [
                'skill'        => ['name' => 'Misc'],
                'technologies' => ['Amazon AWS', 'Docker', 'Linux', 'PHPUnit'],
            ],
        ],
        'work_experiences' => [
            [
                'title'       => 'Full Stack Developer',
                'company'     => 'Clark UK',
                'location'    => 'Bristol',
                'start_date'  => '2023-05-01',
                'end_date'    => null,
                'description' => 'Currently working on the admin system used by advisors to sell insurance to customers',
                'responsibilities' => [
                    'The Insurance system is built with Laravel, Vue.js and Typescipt',
                    'Worked on projects such as adding medical insurance, upgrading to Vue 3 and integrating the Brevo CMS',
                    'Work is conducted in weekly sprints using Jira with the rest of the team',
                    'Unit tests are written with Pest to keep up with our minimum target of 80% code coverage',
                ],
                'active' => true,
            ],
            [
                'title'       => 'Software Developer',
                'company'     => 'Tucasi',
                'location'    => 'Eastleigh',
                'start_date'  => '2020-11-01',
                'end_date'    => '2023-04-28',
                'description' => 'Worked on school payment apps and classroom seat planner',
                'responsibilities' => [
                    'Majority of work has been on the seat planner app built in a custom PHP framework',
                    'Worked on a laravel REST API to centralise school data',
                    'Developed Angular frontend school apps which interact with the API',
                    'Built an Android / iOS homework web app using Ionic framework',
                    'For half a year I switched over to programming with Java as school payment apps was built with it',
                ],
                'active' => true,
            ],
            [
                'title'       => 'PHP Developer',
                'company'     => 'MRI Software',
                'location'    => 'Sutton Coldfield',
                'start_date'  => '2019-07-01',
                'end_date'    => '2020-10-01',
                'description' => 'Worked in the housing repair services team for MRI software',
                'responsibilities' => [
                    'Worked on the House repairs PHP system which provides services to multiple clients',
                    'Developed a REST API in PHP using Laravel to modernise and migrate functionality off of the legacy system',
                    'Trained in and worked with C# and Angular to support other apps',
                ],
                'active' => true,
            ],
            [
                'title'       => 'Senior Developer',
                'company'     => 'MoreNiche',
                'location'    => 'Nottingham',
                'start_date'  => '2018-01-01',
                'end_date'    => '2019-07-01',
                'description' => 'MoreNiche is an affiliate network that specialise in fitness products',
                'responsibilities' => [
                    'Developed a Laravel API to manage data, also included API testing',
                    'Worked on a high traffic tracking server built with the Silex PHP framework',
                    'Worked with both Scrum and Kanban',
                    'Been on-call outside of work hours to maintain uptime of servers',
                ],
                'active' => true,
            ],
            [
                'title'       => 'Web Developer',
                'company'     => 'FPS Distribution',
                'location'    => 'Stratford-upon-Avon',
                'start_date'  => '2016-06-01',
                'end_date'    => '2018-01-01',
                'description' => 'FPS distribution is a b2b company providing car parts to their clients',
                'responsibilities' => [
                    'Built and migrated features to a new Laravel API to replace the previous one built in NodeJS and Express',
                    'Worked on Drupal PHP modules for the company\'s ticketing system and company portal',
                ],
                'active' => true,
            ],
            [
                'title'       => 'Software Developer',
                'company'     => 'Carphone Warehouse',
                'location'    => 'Loughborough',
                'start_date'  => '2015-06-01',
                'end_date'    => '2016-04-01',
                'description' => 'This carphone Warehouse branch involved work with TalkTalk, E2Save and Mobiles',
                'responsibilities' => [
                    'Worked on PHP e-commerce and backend management systems',
                    'Also worked on an in-store BackboneJS SPA app providing phone deals',
                ],
                'active' => false,
            ],
            [
                'title'       => 'Web Developer',
                'company'     => 'Twist Digital',
                'location'    => 'Nottingham',
                'start_date'  => '2013-04-01',
                'end_date'    => '2015-06-01',
                'description' => 'Twist Digital was an affiliate network that provided health, beauty, fitness and adult products',
                'responsibilities' => [
                    'Worked on the company’s dashboard and tracking apps built with Zend, Silex and MongoDB',
                    'Maintained uptime of live servers',
                    'Supported and mentored junior web developers',
                ],
                'active' => false,
            ]
        ],
    ],
    'portfolio' => [
        'intro' => [
            'line1' => "Hello, I'm Mesh",
            'line2' => "I'm a Software Developer with " . DynamicValueEnum::YEARS_WORKED->value . " years experience",
        ],
        'about' => [
            'text' => "<p>I'm a full stack developer with web development experience in PHP / Javascript, " .
                      "Amazon AWS linux server related setup / maintenance work and mobile development implementing " .
                      "native / web apps for both Android and iOS devices.</p>" .
                      "<p>For a long time I've been interested in software development and continue to spend time researching " .
                      "and improving upon my skills and experience in new and popular technologies.</p>",
            'skills' => [
                'name' => 'Portfolio',
                'technologies' => [
                    'PHP',
                    'Laravel',
                    'Node.js',
                    'MySQL',
                    'MongoDB',
                    'Vue.js',
                    'React',
                    'Angular'
                ],
            ],
        ],
        'repositories' => [
            [
                'name' => 'CV',
                'url'  => 'https://github.com/meshu-dev/cv',
            ],
            [
                'name' => 'MeshPro API',
                'url'  => 'https://github.com/meshu-dev/meshpro-api',
            ],
            [
                'name' => 'Dev Nudge',
                'url'  => 'https://github.com/meshu-dev/requiredev',
            ],
            [
                'name' => 'Dev Push',
                'url'  => 'https://github.com/meshu-dev/devpush',
            ],
            [
                'name' => 'Dev Push WP',
                'url'  => 'https://github.com/meshu-dev/devpush-wp',
            ],
            [
                'name' => 'Dev Push API',
                'url'  => 'https://github.com/meshu-dev/devpush-api',
            ],
        ],
        'projects' => [
            [
                'name'         => 'CV',
                'description'  => 'Digital CV',
                'url'          => 'https://cv.meshpro.io',
                'repositories' => [
                    'CV',
                    'MeshPro API',
                ],
                'technologies' => [
                    'React',
                    'Next.js',
                    'Laravel',
                ],
                'file' => [
                    'name' => 'cv.png',
                    'url'  => fake()->placeholderImageUrl(512, 512),
                ],
            ],
            [
                'name'         => 'Dev Nudge',
                'description'  => 'Developer blog',
                'url'          => 'https://devnudge.io',
                'repositories' => [
                    'CV',
                    'MeshPro API',
                ],
                'technologies' => [
                    'Astro',
                    'Laravel',
                ],
                'file' => [
                    'name' => 'devnudge.png',
                    'url'  => fake()->placeholderImageUrl(512, 512),
                ],
            ],
        ],
    ],
    'technologies' => [
        'PHP',
        'Java',
        'Backbone.js',
        'jQuery',
        'Sass',
        'Symfony',
        'Amazon AWS',
        'Docker',
        'PHPUnit',
        'Objective-C',
        'C#',
        'Laravel',
        'Wordpress',
        'Node.js',
        'MySQL',
        'MongoDB',
        'PostgreSQL',
        'Express.js',
        'Fastify',
        'Angular',
        'React',
        'Next.js',
        'Vue.js',
        'Nuxt',
        'GraphQL',
        'Linux',
        'TailwindCSS',
        'Astro',
        '.NET',
    ],
    'sites' => [
        [
            'name' => 'GitHub',
            'url'  => 'https://github.com/meshu-dev',
            'icon' => 'i-simple-icons-github',
            'types' => [
                TypeEnum::CV->value,
                TypeEnum::PORTFOLIO->value,
            ],
            'file' => [
                'name' => 'github.png',
                'url'  => fake()->placeholderImageUrl(64, 64),
            ],
        ],
        [
            'name' => 'LinkedIn',
            'url'  => 'https://www.linkedin.com/in/harmeshuppal',
            'icon' => 'i-simple-icons-linkedin',
            'types' => [
                TypeEnum::CV->value,
                TypeEnum::PORTFOLIO->value,
            ],
            'file' => [
                'name' => 'linkedin.png',
                'url'  => fake()->placeholderImageUrl(64, 64),
            ],
        ],
        [
            'name' => 'Portfolio',
            'url'  => 'https://meshpro.io/portfolio',
            'icon' => null,
            'types' => [
                TypeEnum::CV->value,
            ],
            'file' => [
                'name' => 'portfolio.png',
                'url'  => fake()->placeholderImageUrl(64, 64),
            ],
        ],
    ],
];
