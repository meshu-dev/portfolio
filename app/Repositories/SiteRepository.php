<?php

namespace App\Repositories;

use App\Enums\TypeEnum;
use App\Models\Site;
use Illuminate\Support\Collection;

class SiteRepository
{
    /**
     * @return Collection<int, Site>
     */
    public function getAll(): Collection
    {
        return Site::get();
    }

    /**
     * @return Collection<int, Site>
     */
    public function getByNames(TypeEnum $type, array $names = []): Collection
    {
        $query = Site::with(['files' => function ($query) use ($type) {
            $query->where('type_id', $type->value);
        }]);

        if ($names) {
            $query = $query->whereIn('name', $names);
        }

        return $query->get();
    }
}
