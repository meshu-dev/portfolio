<?php

namespace App\Actions\Portfolio\Intro;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Enums\{TypeEnum};
use App\Http\Resources\SiteResource;
use App\Models\Intro;
use App\Repositories\SiteRepository;

class GetIntroAction
{
    public function __construct(
        protected SiteRepository $siteRepository
    ) {
    }

    /**
     * @return array<string, mixed>
     */
    public function execute(int $userId, bool $format = false): array
    {
        $intro = Intro::where('user_id', $userId)->firstOrFail();
        $sites = $this->siteRepository->getByNames(TypeEnum::PORTFOLIO, ['GitHub', 'LinkedIn']);

        $line1 = $intro->line1;
        $line2 = $intro->line2;

        $line2 = $format ? resolve(GetDynamicTextAction::class)->execute($line2) : $line2;

        return [
            'line1' => $line1,
            'line2' => $line2,
            'sites' => SiteResource::collection($sites)
        ];
    }
}
