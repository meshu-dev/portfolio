<?php

namespace App\Actions\Portfolio;

use App\Enums\TypeEnum;
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
    ) { }

    public function execute(): array
    {
        $introTexts = $this->textRepository
                           ->getByNames(['portfolio_intro_1', 'portfolio_intro_2'])
                           ->toArray();
        $sites = $this->siteRepository->getByNames(TypeEnum::PORTFOLIO, ['GitHub', 'LinkedIn']);

        return [
            'line1' => $introTexts['portfolio_intro_1'],
            'line2' => $introTexts['portfolio_intro_2'],
            'sites' => SiteResource::collection($sites)
        ];
    }
}