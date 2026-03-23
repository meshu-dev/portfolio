<?php

namespace App\Actions\Site;

use App\Enums\TypeEnum;
use App\Models\Site;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class GetSitesByTypeAction
{
    /**
     * @return Collection<int, Site>
     */
    public function execute(int $userId, TypeEnum $type): Collection
    {
        return Site::where('user_id', $userId)
                   ->whereHas('types', function (Builder $query) use ($type) {
                        $query->where('types.id', $type->value);
                   })
                   ->get();
    }
}
