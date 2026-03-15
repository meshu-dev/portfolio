<?php

namespace App\Actions\Type;

use App\Models\Type;
use Illuminate\Support\Collection;

class GetAllTypesAction
{
    /**
     * @return Collection<int, Type>
     */
    public function execute(): Collection
    {
        return Type::all();
    }
}
