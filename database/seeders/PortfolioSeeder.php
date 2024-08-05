<?php

namespace Database\Seeders;

use App\Enums\DynamicValueEnum;
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
                'name' => 'MeshPro API',
                'url'  => 'https://github.com/meshu-dev/meshpro-api'
            ]),
            Repository::create([
                'name' => 'Dev Nudge',
                'url'  => 'https://github.com/meshu-dev/requiredev'
            ]),
            Repository::create([
                'name' => 'Dev Push',
                'url'  => 'https://github.com/meshu-dev/devpush'
            ]),
            Repository::create([
                'name' => 'Dev Push WP',
                'url'  => 'https://github.com/meshu-dev/devpush-wp'
            ]),
            Repository::create([
                'name' => 'Dev Push API',
                'url'  => 'https://github.com/meshu-dev/devpush-api'
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
            'value' => "I'm a Software Developer with " . DynamicValueEnum::YEARS_WORKED->value . " years experience"
        ]);
    }

    protected function addAboutText()
    {
        $aboutMe = "<p>I'm a full stack developer with web development experience in PHP / Javascript, " .
            "Amazon AWS linux server related setup / maintenance work and mobile development implementing " .
            "native / web apps for both Android and iOS devices.</p>" .
            "<p>For a long time I've been interested in software development and continue to spend time researching " .
            "and improving upon my skills and experience in new and popular technologies.</p>";

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
            $meshProApiRepo,
            $devNudgeRepo,
            $devPushRepo,
            $devPushWpRepo,
            $devPushApiRepo
        ] = $repositories;

        $cvProject = Project::create([
            'name'        => 'CV',
            'description' => 'Digital CV',
            'url'         => 'https://cv.meshupro.io'
        ]);

        $cvProject->repositories()->save($cvRepo);
        $cvProject->repositories()->save($meshProApiRepo);

        $this->addProjectTechnologies($cvProject, ['React', 'Next.js', 'Laravel']);
        $this->addProjectFile('site/cv.jpg');

        $devNudgeProject = Project::create([
            'name'        => 'Dev Nudge',
            'description' => 'Developer blog',
            'url'         => 'https://devnudge.io'
        ]);

        $devNudgeProject->repositories()->save($devNudgeRepo);

        $this->addProjectTechnologies($devNudgeProject, ['Astro']);
        $this->addProjectFile('site/devnudge.jpg');

        $devPushProject = Project::create([
            'name'        => 'Dev Push',
            'description' => 'Beginner developer blog',
            'url'         => 'https://devpush.io'
        ]);

        $devPushProject->repositories()->save($devPushRepo);
        $devPushProject->repositories()->save($devPushWpRepo);
        $devPushProject->repositories()->save($devPushApiRepo);

        $this->addProjectTechnologies($devPushProject, ['Wordpress', 'React', 'Next.js', 'Laravel']);
        $this->addProjectFile('site/devpush.jpg');
    }

    protected function addProjectFile($filename): void
    {
        $projectFileUrl = Storage::disk('s3')->url($filename);

        if ($projectFileUrl) {
            File::insert([
                'name' => basename($filename),
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
