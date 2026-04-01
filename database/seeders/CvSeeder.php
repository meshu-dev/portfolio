<?php

namespace Database\Seeders;

use App\Models\{
    Profile,
    Skill,
    Technology,
    WorkExperience
};
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class CvSeeder extends Seeder
{
    protected array $data;

    public function run(Collection $users): void
    {
        $this->data = require('data/user_data.php');
        $this->data = $this->data['cv'];

        foreach ($users as $user) {
            $this->addProfile($user->id);
            $this->addSkills($user->id);
            $this->addWorkExperiences($user->id);
        }
    }

    protected function addProfile(int $userId)
    {
        $params = $this->data['profile'];
        $params['user_id'] = $userId;

        Profile::create($params);
    }

    protected function addSkills(int $userId)
    {
        $skills = $this->data['skills'];

        foreach ($skills as $skill) {
            $skill['skill']['user_id'] = $userId;
            $skillModel = Skill::create($skill['skill']);

            $this->addSkillTechnologies($skillModel, $skill['technologies']);
        }
    }

    protected function addSkillTechnologies(Skill $skill, array $technologies)
    {
        foreach ($technologies as $technology) {
            $skill->technologies()->save(Technology::where('name', $technology)->first());
        }
    }

    protected function addWorkExperiences(int $userId)
    {
        $workExperiences = $this->data['work_experiences'];

        foreach ($workExperiences as $workExperience) {
            $workExperience['user_id'] = $userId;
            WorkExperience::create($workExperience);
        }
    }
}
