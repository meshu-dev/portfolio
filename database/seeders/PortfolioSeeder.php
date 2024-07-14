<?php

namespace Database\Seeders;

use App\Models\{
    File,
    Project,
    Repository,
    Skill,
    Technology,
    Text
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->addIntroText();
        $this->addAboutText();
        $this->addSkills();

        $repositories = $this->addRepositories();

        $this->addProjects($repositories);
    }

    protected function addRepositories(): array
    {
        return [
            Repository::create([
                'name' => 'CV',
                'url'  => 'https://github.com/meshu-dev/cv'
            ]),
            Repository::create([
                'name' => 'Mailer',
                'url'  => 'https://github.com/meshu-dev/mailer'
            ]),
            Repository::create([
                'name' => 'Sites',
                'url'  => 'https://github.com/meshu-dev/sites'
            ]),
            Repository::create([
                'name' => 'Crypto',
                'url'  => 'https://github.com/meshu-dev/crypto'
            ]),
            Repository::create([
                'name' => 'Crypto API',
                'url'  => 'https://github.com/meshu-dev/crypto-api'
            ]),
            Repository::create([
                'name' => 'Backlog',
                'url'  => 'https://github.com/meshu-dev/backlog'
            ]),
            Repository::create([
                'name' => 'Backlog API',
                'url'  => 'https://github.com/meshu-dev/backlog-api'
            ]),
            Repository::create([
                'name' => 'Admin',
                'url'  => 'https://github.com/meshu-dev/admin'
            ]),
            Repository::create([
                'name' => 'RequireDev',
                'url'  => 'https://github.com/meshu-dev/requiredev'
            ])
        ];
    }

    protected function addIntroText()
    {
        Text::insert([
            'name'  => 'portfolio_intro_1',
            'value' => "Hello, I'm Mesh"
        ]);

        Text::insert([
            'name'  => 'portfolio_intro_2',
            'value' => "I'm a Software Developer with 13 years experience"
        ]);
    }

    protected function addAboutText()
    {
        $aboutMe = "I'm a full stack developer with web development experience in PHP / Javascript, " .
            "Amazon AWS linux server related setup / maintenance work and mobile development implementing " .
            "native / web apps for both Android and iOS devices.\n\n" .
            "For a long time I've been interested in software development and continue to spend time researching " .
            "and improving upon my skills and experience in new and popular technologies.";

        Text::insert([
            'name'  => 'about',
            'value' => $aboutMe
        ]);
    }

    protected function addSkills()
    {
        $portfolioSkill = Skill::create(['name' => 'Portfolio']);

        $this->addSkillTechnologies(
            $portfolioSkill,
            [
                'PHP',
                'Laravel',
                'Node.js',
                'MySQL',
                'MongoDB',
                'Vue.js',
                'React',
                'Angular'
            ]
        );
    }

    protected function addSkillTechnologies(Skill $skill, array $technologies)
    {
        foreach ($technologies as $technology) {
            $skill->technologies()->save(Technology::where('name', $technology)->first());
        }
    }

    protected function addProjects(array $repositories): void
    {
        [
            $cvRepo,
            $mailerRepo,
            $siteRepo,
            $cryptoRepo,
            $cryptoApiRepo,
            $backlogRepo,
            $backlogApiRepo,
            $adminRepo,
            $requireDevRepo
        ] = $repositories;

        $backlogProject = Project::create([
            'name'        => 'Backlog',
            'description' => 'Backlog manager for movies and TV shows',
            'url'         => 'https://backlog.meshu.app'
        ]);

        $backlogProject->repositories()->save($backlogApiRepo);
        $backlogProject->repositories()->save($backlogRepo);

        $this->addProjectTechnologies($backlogProject, ['Laravel', 'MySQL', 'Vue.js']);
        $this->addProjectFile('backlog.jpg');

        $adminProject = Project::create([
            'name'        => 'Admin',
            'description' => 'Admin panel to manage data',
            'url'         => 'https://admin.meshu.app'
        ]);

        $adminProject->repositories()->save($adminRepo);

        $this->addProjectTechnologies($adminProject, ['Laravel', 'MySQL', 'React']);
        $this->addProjectFile('admin.jpg');

        $requireDevProject = Project::create([
            'name'        => 'RequireDev',
            'description' => 'PHP / Javasript tutorial blog',
            'url'         => 'https://www.requiredev.com'
        ]);

        $requireDevProject->repositories()->save($requireDevRepo);

        $this->addProjectTechnologies($requireDevProject, ['Wordpress', 'React', 'Next.js', 'GraphQL']);
        $this->addProjectFile('requiredev.jpg');

        $cvProject = Project::create([
            'name'        => 'CV',
            'description' => 'Digital version of my CV',
            'url'         => 'https://cv.meshu.app'
        ]);

        $cvProject->repositories()->save($cvRepo);

        $this->addProjectTechnologies($cvProject, ['React', 'Next.js', 'MongoDB']);
        $this->addProjectFile('cv.jpg');

        $mailerProject = Project::create([
            'name'        => 'Mailer',
            'description' => 'E-mail sender service',
            'url'         => 'https://mailer.meshu.app'
        ]);

        $mailerProject->repositories()->save($mailerRepo);

        $this->addProjectTechnologies($mailerProject, ['React', 'Next.js']);
        $this->addProjectFile('mailer.jpg');

        $sitesProject = Project::create([
            'name'        => 'Sites',
            'description' => 'Tool to manage websites',
            'url'         => 'https://sites.meshu.app'
        ]);

        $sitesProject->repositories()->save($siteRepo);

        $this->addProjectTechnologies($sitesProject, ['React', 'Next.js', 'PostgreSQL']);
        $this->addProjectFile('sites.jpg');

        $cryptoProject = Project::create([
            'name'        => 'Crypto',
            'description' => 'Realtime cryptocurrency price list',
            'url'         => 'https://crypto.meshu.app'
        ]);

        $cryptoProject->repositories()->save($cryptoApiRepo);
        $cryptoProject->repositories()->save($cryptoRepo);

        $this->addProjectTechnologies($cryptoProject, ['React', 'Next.js', 'MongoDB']);
        $this->addProjectFile('crypto.jpg');
    }

    protected function addProjectFile($filename): void
    {
        $projectFileUrl = Storage::disk('s3')->url($filename);

        if ($projectFileUrl) {
            File::insert([
                'name' => $filename,
                'url'  => $projectFileUrl
            ]);
        }
    }

    protected function addProjectTechnologies(Project $project, array $technologies): void
    {
        foreach ($technologies as $technology) {
            $project->technologies()->save(Technology::where('name', $technology)->first());
        }
    }
}
