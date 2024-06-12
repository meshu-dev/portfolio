<?php

namespace App\Repositories;

use App\Models\Text;

class TextRepository
{
    public function getAll()
    {
        return Text::get();
    }

    public function getKeyValues()
    {
        return $this->getAll()
                    ->mapWithKeys(fn ($item) => [$item->key => $item->value]);
    }
}
