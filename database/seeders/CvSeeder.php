<?php

namespace Database\Seeders;

use App\Models\{
    File,
    Text,
    Icon,
    Skill,
    Technology,
    WorkExperience
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CvSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->addProfileData();
        $this->addSkills();
        $this->addWorkExperiences();
        $this->addPdf();
    }

    protected function addProfileData()
    {
        Text::insert([
            [
                'name'  => 'fullname',
                'value' => 'Harmesh Uppal'
            ],
            [
                'name'  => 'intro',
                'value' => 'Full-stack developer with over 12 years experience in PHP and JavaScript'
            ],
            [
                'name'  => 'location',
                'value' => 'West Midlands, UK'
            ]
        ]);

        /*
        Icon::insert([
            [
                'name'      => 'GitHub',
                'url'       => 'https://github.com/meshu-dev',
                'image_url' => 'https://cv.meshu.app/images/github-icon.png'
            ],
            [
                'name'      => 'LinkedIn',
                'url'       => 'https://www.linkedin.com/in/harmeshuppal',
                'image_url' => 'https://cv.meshu.app/images/linkedin-icon.png'
            ],
            [
                'name'      => 'Portfolio',
                'url'       => 'https://meshu.net',
                'image_url' => 'https://cv.meshu.app/images/site-icon.png'
            ]
        ]); */
    }

    protected function addSkills()
    {
        $backendSkill   = Skill::create(['name' => 'Backend']);
        $frontendSkill  = Skill::create(['name' => 'Frontend']);
        $frameworkSkill = Skill::create(['name' => 'Frameworks']);
        $miscSkill      = Skill::create(['name' => 'Misc']);

        $this->addSkillTechnologies($backendSkill, ['PHP', 'MySQL', 'Node.js', 'Java']);
        $this->addSkillTechnologies($frontendSkill, ['Vue.js', 'React', 'Angular', 'TailwindCSS']);
        $this->addSkillTechnologies($frameworkSkill, ['Laravel', 'Wordpress', 'Express.js', 'Symfony']);
        $this->addSkillTechnologies($miscSkill, ['Amazon AWS', 'Docker', 'Linux', 'PHPUnit']);
    }

    protected function addSkillTechnologies(Skill $skill, array $technologies)
    {
        foreach ($technologies as $technology) {
            $skill->technologies()->save(Technology::where('name', $technology)->first());
        }
    }

    protected function addWorkExperiences()
    {
        WorkExperience::insert([
            [
                'title'       => 'Software Developer',
                'company'     => 'Tucasi',
                'location'    => 'Eastleigh',
                'date'        => 'Nov 20 – Present',
                'description' => 'Currently working on school payment apps, previously worked on a seat planner app',
                'responsibilities' => json_encode([
                    'Majority of work has been on the seat planner app built in a custom PHP framework',
                    'Worked on a laravel REST API to centralise school data',
                    'Developed Angular frontend school apps which interact with API',
                    'Built an Android / iOS homework web app using Ionic framework',
                    'Recently switched to Java as school payment apps are built with it'
                ])
            ],
            [
                'title'       => 'PHP Developer',
                'company'     => 'MRI Software',
                'location'    => 'Sutton Coldfield',
                'date'        => 'Jul 19 – Oct 20',
                'description' => 'Worked in the housing repair services team for MRI software',
                'responsibilities' => json_encode([
                    'Worked on the House repairs PHP system which provides services to multiple clients',
                    'Developed a REST API in PHP using Laravel to modernise and migrate functionality off of the legacy system',
                    'Trained in and worked with C# and Angular to support other apps'
                ])
            ],
            [
                'title'       => 'Senior Developer',
                'company'     => 'MoreNiche',
                'location'    => 'Nottingham',
                'date'        => 'Jan 18 – Jul 19',
                'description' => 'MoreNiche is an affiliate network that specialise in fitness products',
                'responsibilities' => json_encode([
                    'Developed a Laravel API to manage data, also included API testing',
                    'Worked on a high traffic tracking server built with the Silex PHP framework',
                    'Worked with both Scrum and Kanban',
                    'Been on-call outside of work hours to maintain uptime of servers'
                ])
            ],
            [
                'title'       => 'Web Developer',
                'company'     => 'FPS Distribution',
                'location'    => 'Stratford-upon-Avon',
                'date'        => 'Jun 16 – Jan 18',
                'description' => 'FPS distribution is a b2b company providing car parts to their clients',
                'responsibilities' => json_encode([
                    'Built and migrated features to a new Laravel API to replace the previous one built in NodeJS and Express',
                    'Worked on Drupal PHP modules for the company\'s ticketing system and company portal'
                ])
            ],
            [
                'title'       => 'Software Developer',
                'company'     => 'Carphone Warehouse',
                'location'    => 'Loughborough',
                'date'        => 'Jun 15 – Apr 16',
                'description' => 'This carphone Warehouse branch involved work with TalkTalk, E2Save and Mobiles',
                'responsibilities' => json_encode([
                    'Worked on PHP e-commerce and backend management systems',
                    'Also worked on an in-store BackboneJS SPA app providing phone deals'
                ])
            ],
            [
                'title'       => 'Web Developer',
                'company'     => 'Twist Digital',
                'location'    => 'Nottingham',
                'date'        => 'Apr 13 – Jun 15',
                'description' => 'Twist Digital was an affiliate network that provided health, beauty, fitness and adult products',
                'responsibilities' => json_encode([
                    'Worked on the company’s dashboard and tracking apps built with Zend, Silex and MongoDB',
                    'Maintained uptime of live servers',
                    'Supported and mentored junior web developers'
                ])
            ]
        ]);
    }

    protected function addPdf()
    {
        $cvFileUrl = Storage::disk('s3')->url('cv.pdf');

        if ($cvFileUrl) {
            File::insert([
                'name' => 'cv.pdf',
                'url'  => $cvFileUrl
            ]);
        }
    }
}
