<?php

namespace App\Actions\Portfolio\Intro;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Enums\{TypeEnum};
use App\Http\Resources\SiteResource;
use App\Repositories\{
    TextRepository,
    SiteRepository
};

class GetIntroAction
{
    public function __construct(
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(int $userId, bool $format = false): array
    {
        $introTexts = $this->textRepository
                           ->getByNames($userId, ['portfolio_intro_1', 'portfolio_intro_2'])
                           ->toArray();
        $sites = $this->siteRepository->getByNames(TypeEnum::PORTFOLIO, ['GitHub', 'LinkedIn']);

        $line1 = $introTexts['portfolio_intro_1'];
        $line2 = $introTexts['portfolio_intro_2'];

        $line2 = $format ? resolve(GetDynamicTextAction::class)->execute($line2) : $line2;

        return [
            'line1' => $line1,
            'line2' => $line2,
            'sites' => SiteResource::collection($sites)
        ];
    }
}
