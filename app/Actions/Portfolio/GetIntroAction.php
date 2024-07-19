<?php

namespace App\Actions\Portfolio;

use App\Repositories\TextRepository;

class GetIntroAction
{
    public function __construct(
        protected TextRepository $textRepository
    ) { }

    public function execute(): array
    {
        return $this->textRepository
                    ->getByNames(["portfolio_intro_1", "portfolio_intro_2"])
                    ->toArray();
    }
}