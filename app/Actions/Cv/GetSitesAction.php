<?php

namespace App\Actions\Cv;

use App\Enums\TypeEnum;
use App\Models\Site;
use App\Repositories\SiteRepository;
use Illuminate\Support\Collection;

class GetSitesAction
{
    public function __construct(
        protected SiteRepository $siteRepository
    ) {
    }

    /**
     * @return Collection<int, Site>
     */
    public function execute(): Collection
    {
        return $this->siteRepository->getByNames(TypeEnum::CV);
    }
}
