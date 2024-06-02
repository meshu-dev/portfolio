<?php

namespace Database\Seeders;

use App\Models\{
    Project,
    Repository,
    Technology
};
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Repositories
        $cvRepo = Repository::create([
            'name' => 'CV',
            'url'  => 'https://github.com/meshu-dev/cv'
        ]);

        $mailerRepo = Repository::create([
            'name' => 'Mailer',
            'url'  => 'https://github.com/meshu-dev/mailer'
        ]);

        $siteRepo = Repository::create([
            'name' => 'Sites',
            'url'  => 'https://github.com/meshu-dev/sites'
        ]);

        $cryptoRepo = Repository::create([
            'name' => 'Crypto',
            'url'  => 'https://github.com/meshu-dev/crypto'
        ]);

        $cryptoApiRepo = Repository::create([
            'name' => 'Crypto API',
            'url'  => 'https://github.com/meshu-dev/crypto-api'
        ]);

        $backlogRepo = Repository::create([
            'name' => 'Backlog',
            'url'  => 'https://github.com/meshu-dev/backlog'
        ]);

        $backlogApiRepo = Repository::create([
            'name' => 'Backlog API',
            'url'  => 'https://github.com/meshu-dev/backlog-api'
        ]);

        $adminRepo = Repository::create([
            'name' => 'Admin',
            'url'  => 'https://github.com/meshu-dev/admin'
        ]);

        $requireDevRepo = Repository::create([
            'name' => 'RequireDev',
            'url'  => 'https://github.com/meshu-dev/requiredev'
        ]);

        // Projects
        $backlogProject = Project::create([
            'name'        => 'Backlog',
            'description' => 'Backlog manager for movies and TV shows',
            'url'         => 'https://backlog.meshu.app'
        ]);

        $backlogProject->repositories()->save($backlogApiRepo);
        $backlogProject->repositories()->save($backlogRepo);

        $this->addProjectTechnologies($backlogProject, ['Laravel', 'MySQL', 'Vue.js']);

        $adminProject = Project::create([
            'name'        => 'Admin',
            'description' => 'Admin panel to manage data',
            'url'         => 'https://admin.meshu.app'
        ]);

        $adminProject->repositories()->save($adminRepo);

        $this->addProjectTechnologies($backlogProject, ['Laravel', 'MySQL', 'React']);

        $requireDevProject = Project::create([
            'name'        => 'RequireDev',
            'description' => 'PHP / Javasript tutorial blog',
            'url'         => 'https://www.requiredev.com'
        ]);

        $requireDevProject->repositories()->save($requireDevRepo);

        $this->addProjectTechnologies($backlogProject, ['Wordpress', 'React', 'Next.js', 'GraphQL']);

        $cvProject = Project::create([
            'name'        => 'CV',
            'description' => 'Digital version of my CV',
            'url'         => 'https://cv.meshu.app'
        ]);

        $cvProject->repositories()->save($cvRepo);

        $this->addProjectTechnologies($backlogProject, ['React', 'Next.js', 'MongoDB']);

        $mailerProject = Project::create([
            'name'        => 'Mailer',
            'description' => 'E-mail sender service',
            'url'         => 'https://mailer.meshu.app'
        ]);

        $mailerProject->repositories()->save($mailerRepo);

        $this->addProjectTechnologies($backlogProject, ['React', 'Next.js']);

        $sitesProject = Project::create([
            'name'        => 'Sites',
            'description' => 'Tool to manage websites',
            'url'         => 'https://sites.meshu.app'
        ]);

        $sitesProject->repositories()->save($siteRepo);

        $this->addProjectTechnologies($backlogProject, ['React', 'Next.js', 'PostgreSQL']);

        $cryptoProject = Project::create([
            'name'        => 'Crypto',
            'description' => 'Realtime cryptocurrency price list',
            'url'         => 'https://crypto.meshu.app'
        ]);

        $cryptoProject->repositories()->save($cryptoApiRepo);
        $cryptoProject->repositories()->save($cryptoRepo);

        $this->addProjectTechnologies($backlogProject, ['React', 'Next.js', 'MongoDB']);
    }

    protected function addProjectTechnologies(Project $project, array $technologies)
    {
        foreach ($technologies as $technology) {
            $project->technologies()->save(Technology::where('name', $technology)->first());
        }
    }
}
