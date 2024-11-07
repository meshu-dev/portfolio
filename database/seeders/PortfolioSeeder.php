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
        $this->addAboutData();
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

    protected function addAboutData()
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

        $imageUrl = config('app.add_seeder_files') ? Storage::disk('s3')->url('site/about.png') : fake()->imageUrl();

        File::insert([
            'name' => 'about.png',
            'url'  => $imageUrl
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
            'url'         => 'https://cv.meshpro.io'
        ]);

        $cvProject->repositories()->save($cvRepo);
        $cvProject->repositories()->save($meshProApiRepo);

        $this->addProjectTechnologies($cvProject, ['React', 'Next.js', 'Laravel']);
        $file = $this->addProjectFile('site/cv.png');

        if ($file) {
            $cvProject->files()->save($file);
        }

        $devNudgeProject = Project::create([
            'name'        => 'Dev Nudge',
            'description' => 'Developer blog',
            'url'         => 'https://devnudge.io'
        ]);

        $devNudgeProject->repositories()->save($devNudgeRepo);

        $this->addProjectTechnologies($devNudgeProject, ['Astro', 'Laravel']);
        $file = $this->addProjectFile('site/devnudge.png');

        if ($file) {
            $devNudgeProject->files()->save($file);
        }
    }

    protected function addProjectFile($filename): File|null
    {
        $imageUrl = config('app.add_seeder_files') ? Storage::disk('s3')->url($filename) : fake()->imageUrl();

        return File::create([
            'name' => basename($filename),
            'url'  => $imageUrl
        ]);
    }

    protected function addProjectTechnologies(Project $project, array $technologies): void
    {
        foreach ($technologies as $technology) {
            $project->technologies()->save(Technology::where('name', $technology)->first());
        }
    }
}
