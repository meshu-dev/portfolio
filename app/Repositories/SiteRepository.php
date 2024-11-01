<?php

namespace App\Repositories;

use App\Enums\TypeEnum;
use App\Models\Site;

class SiteRepository
{
    public function getAll()
    {
        return Site::get();
    }

    public function getByNames(TypeEnum $type, array $names = [])
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
