<?php

namespace App\Repositories;

use App\Models\ProfileDetail;

class ProfileDetailRepository
{
    public function getAll()
    {
        return ProfileDetail::get();
    }

    public function getKeyValues()
    {
        return $this->getAll()
                    ->mapWithKeys(fn ($item) => [$item->key => $item->value]);
    }
}
