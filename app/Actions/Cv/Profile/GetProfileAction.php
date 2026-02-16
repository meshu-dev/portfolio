<?php

namespace App\Actions\Cv\Profile;

use App\Actions\Portfolio\GetDynamicTextAction;
use App\Enums\TypeEnum;
use App\Http\Resources\SiteResource;
use App\Repositories\{
    TextRepository,
    SiteRepository
};
use Illuminate\Support\Facades\Auth;

class GetProfileAction
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
        $details = $this->textRepository->getByNames(Auth::id(), ['fullname', 'intro', 'location']);
        $sites   = $this->siteRepository->getByNames(TypeEnum::CV);

        $details['intro'] = resolve(GetDynamicTextAction::class)->execute($details['intro']);

        return [
            'details' => $details,
            'sites'   => SiteResource::collection($sites)
        ];
    }
}
