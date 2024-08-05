<?php

namespace App\Actions\Portfolio;

use App\Enums\{DynamicValueEnum, TypeEnum};
use App\Http\Resources\SiteResource;
use App\Repositories\{
    TextRepository,
    SiteRepository
};
use App\Services\ProfileService;

class GetIntroAction
{
    public function __construct(
        protected ProfileService $profileService,
        protected TextRepository $textRepository,
        protected SiteRepository $siteRepository
    ) {
    }

    public function execute(): array
    {
        $introTexts = $this->textRepository
                           ->getByNames(['portfolio_intro_1', 'portfolio_intro_2'])
                           ->toArray();
        $sites = $this->siteRepository->getByNames(TypeEnum::PORTFOLIO, ['GitHub', 'LinkedIn']);

        $line1 = $introTexts['portfolio_intro_1'];
        $line2 = str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            $this->profileService->getYearsWorked(),
            $introTexts['portfolio_intro_2']
        );

        return [
            'line1' => $line1,
            'line2' => $line2,
            'sites' => SiteResource::collection($sites)
        ];
    }
}