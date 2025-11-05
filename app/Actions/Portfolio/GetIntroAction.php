<?php

namespace App\Actions\Portfolio;

use App\Actions\Profile\GetYearsWorkedAction;
use App\Enums\{DynamicValueEnum, TypeEnum};
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
    public function execute(): array
    {
        $introTexts = $this->textRepository
                           ->getByNames(['portfolio_intro_1', 'portfolio_intro_2'])
                           ->toArray();
        $sites = $this->siteRepository->getByNames(TypeEnum::PORTFOLIO, ['GitHub', 'LinkedIn']);

        $line1 = $introTexts['portfolio_intro_1'];
        $line2 = str_replace(
            DynamicValueEnum::YEARS_WORKED->value,
            (string) resolve(GetYearsWorkedAction::class)->execute(),
            $introTexts['portfolio_intro_2']
        );

        return [
            'line1' => $line1,
            'line2' => $line2,
            'sites' => SiteResource::collection($sites)
        ];
    }
}
