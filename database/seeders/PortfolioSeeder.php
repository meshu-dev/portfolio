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
use Illuminate\Support\Collection;

class PortfolioSeeder extends Seeder
{
    protected array $data;

    public function run(Collection $users): void
    {
        $this->data = require('data/user_data.php');
        $this->data = $this->data['portfolio'];

        foreach ($users as $user) {
            $this->addIntro($user->id);
            $this->addAbout($user->id);
            $this->addRepositories($user->id);
            $this->addProjects($user->id);
        }
    }

    protected function addIntro(int $userId): void
    {
        $params = $this->data['intro'];
        $params['user_id'] = $userId;

        Intro::create($params);
    }

    protected function addAbout(int $userId): void
    {
        $data = $this->data['about'];
        $params = ['user_id' => $userId, 'text' => $data['text']];

        About::create($params);

        $params = ['user_id' => $userId, 'name' => $data['skills']['name']];
        $skill  = Skill::create($params);

        $technologies = $data['skills']['technologies'];

        foreach ($technologies as $technology) {
            $skill->technologies()->save(Technology::where('name', $technology)->first());
        }
    }

    protected function addRepositories(int $userId): void
    {
        $repositories = $this->data['repositories'];

        foreach ($repositories as $repository) {
            $repository['user_id'] = $userId;

            Repository::create($repository);
        }
    }

    protected function addProjects(int $userId): void
    {
        $projects = $this->data['projects'];

        foreach ($projects as $project) {
            $params = [
                'user_id'     => $userId,
                'name'        => $project['name'],
                'description' => $project['description'],
                'url'         => $project['url'],
            ];

            $projectModel = Project::create($params);

            foreach ($project['repositories'] as $repository) {
                $repositoryModel = Repository::where('user_id', $userId)
                                             ->where('name', $repository)
                                             ->first();

                $projectModel->repositories()->save($repositoryModel);
            }

            foreach ($project['technologies'] as $technology) {
                $technologyModel = Technology::where('user_id', $userId)
                                             ->where('name', $technology)
                                             ->first();

                $projectModel->technologies()->save($technologyModel);
            }

            $file = File::create([
                'user_id' => $userId,
                'name'    => $project['file']['name'],
                'url'     => $project['file']['url'],
            ]);

            $projectModel->files()->save($file);
        }
    }
}
