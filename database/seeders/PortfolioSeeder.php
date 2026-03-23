<?php

namespace Database\Seeders;

use App\Actions\File\MoveFileAction;
use App\Enums\DynamicValueEnum;
use App\Enums\UserEnum;
use App\Exceptions\FileNotUploadedException;
use App\Models\{
    About,
    File,
    Intro,
    Project,
    Repository,
    Skill,
    Technology,
    User
};
use Illuminate\Database\Seeder;

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
                'user_id' => UserEnum::ADMIN,
                'name' => 'CV',
                'url'  => 'https://github.com/meshu-dev/cv'
            ]),
            Repository::create([
                'user_id' => UserEnum::ADMIN,
                'name' => 'MeshPro API',
                'url'  => 'https://github.com/meshu-dev/meshpro-api'
            ]),
            Repository::create([
                'user_id' => UserEnum::ADMIN,
                'name' => 'Dev Nudge',
                'url'  => 'https://github.com/meshu-dev/requiredev'
            ]),
            Repository::create([
                'user_id' => UserEnum::ADMIN,
                'name' => 'Dev Push',
                'url'  => 'https://github.com/meshu-dev/devpush'
            ]),
            Repository::create([
                'user_id' => UserEnum::ADMIN,
                'name' => 'Dev Push WP',
                'url'  => 'https://github.com/meshu-dev/devpush-wp'
            ]),
            Repository::create([
                'user_id' => UserEnum::ADMIN,
                'name' => 'Dev Push API',
                'url'  => 'https://github.com/meshu-dev/devpush-api'
            ])
        ];
    }

    protected function addIntroText()
    {
        $users = User::all();

        foreach ($users as $user) {
            Intro::create([
                'user_id' => $user->id,
                'line1'   => "Hello, I'm Mesh",
                'line2'   => "I'm a Software Developer with " . DynamicValueEnum::YEARS_WORKED->value . " years experience",
            ]);
        }
    }

    protected function addAboutData()
    {
        $aboutMe = "<p>I'm a full stack developer with web development experience in PHP / Javascript, " .
            "Amazon AWS linux server related setup / maintenance work and mobile development implementing " .
            "native / web apps for both Android and iOS devices.</p>" .
            "<p>For a long time I've been interested in software development and continue to spend time researching " .
            "and improving upon my skills and experience in new and popular technologies.</p>";

        $users = User::all();

        foreach ($users as $user) {
            $about = About::create([
                'user_id' => $user->id,
                'text'    => $aboutMe,
            ]);

            $file = $this->addFile('about.png');

            if ($file) {
                $about->file_id = $file->id;
                $about->save();
            }
        }
    }

    protected function addSkills()
    {
        $portfolioSkill = Skill::create(['user_id' => UserEnum::ADMIN, 'name' => 'Portfolio']);

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
        ] = $repositories;

        $cvProject = Project::create([
            'user_id'     => UserEnum::ADMIN,
            'name'        => 'CV',
            'description' => 'Digital CV',
            'url'         => 'https://cv.meshpro.io'
        ]);

        $cvProject->repositories()->save($cvRepo);
        $cvProject->repositories()->save($meshProApiRepo);

        $this->addProjectTechnologies($cvProject, ['React', 'Next.js', 'Laravel']);
        $file = $this->addFile('cv.png');

        if ($file) {
            $cvProject->files()->save($file);
        }

        $devNudgeProject = Project::create([
            'user_id'     => UserEnum::ADMIN,
            'name'        => 'Dev Nudge',
            'description' => 'Developer blog',
            'url'         => 'https://devnudge.io'
        ]);

        $devNudgeProject->repositories()->save($devNudgeRepo);

        $this->addProjectTechnologies($devNudgeProject, ['Astro', 'Laravel']);
        $file = $this->addFile('devnudge.png');

        if ($file) {
            $devNudgeProject->files()->save($file);
        }
    }

    protected function addFile($filename): File|null
    {
        try {
            $fileUrl = resolve(MoveFileAction::class)->execute($filename);
        } catch (FileNotUploadedException) {
            $fileUrl = fake()->placeholderImageUrl(512, 512);
        }

        return File::create([
            'user_id' => UserEnum::ADMIN,
            'name'    => $filename,
            'url'     => $fileUrl,
        ]);
    }

    protected function addProjectTechnologies(Project $project, array $technologies): void
    {
        foreach ($technologies as $technology) {
            $project->technologies()->save(Technology::where('name', $technology)->first());
        }
    }
}
