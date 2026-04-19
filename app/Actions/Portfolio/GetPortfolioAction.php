<?php

namespace App\Actions\Portfolio;

use App\Actions\Portfolio\{
    Intro\GetIntroAction,
    About\GetAboutAction,
    Project\GetProjectsAction,
};

class GetPortfolioAction
{
    /**
     * @param int $userId
     * @return array<string, mixed>
     */
    public function execute(int $userId): array
    {
        $intro    = resolve(GetIntroAction::class)->execute($userId);
        $about    = resolve(GetAboutAction::class)->execute($userId);
        $projects = resolve(GetProjectsAction::class)->execute($userId);

        return [
            'intro'    => $intro,
            'about'    => $about,
            'projects' => $projects,
        ];
    }
}
